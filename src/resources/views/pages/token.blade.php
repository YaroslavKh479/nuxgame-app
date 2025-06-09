@extends('layout.base')

@section('content')

    {{-- Alert Box --}}
    <div id="alertBox"
         class="hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-lg shadow z-50">
        <span id="alertText"></span>
    </div>

    <div class="max-w-xl mx-auto mt-12 space-y-8">

        {{-- Section: Link Management --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-xl font-bold mb-4">🔗 Link Management</h2>

            <div class="space-y-4">
                <div>
                    <button id="generateLinkBtn"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition">
                        Generate New Link
                    </button>
                </div>

                <div>
                    <button id="deactivateLinkBtn"
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition">
                        Deactivate Current Link
                    </button>
                </div>

                <div id="linkOutput" class="text-sm text-center mt-4 text-gray-600"></div>
            </div>
        </div>

        {{-- Section: I'm feeling lucky --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-xl font-bold mb-4">🎲 I'm feeling lucky</h2>

            <button id="luckyBtn"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition">
                Try Your Luck
            </button>

            <div id="luckyResult" class="mt-4 text-center text-sm text-gray-800"></div>
        </div>

        {{-- Section: History --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-xl font-bold mb-4">📜 Last 3 Results</h2>

            <ul id="historyList" class="space-y-2 text-sm text-gray-700">
                <li class="text-gray-400">Loading...</li>
            </ul>
        </div>

    </div>

    {{-- Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const apiUrl = `{{ env('APP_URL') }}/api`;
            const token = `{{ $token }}`;
            const linkOutput = document.getElementById('linkOutput');
            const luckyResult = document.getElementById('luckyResult');
            const historyList = document.getElementById('historyList');

            function showAlert(message) {
                const alertBox = document.getElementById('alertBox');
                const alertText = document.getElementById('alertText');
                alertText.textContent = message;
                alertBox.classList.remove('hidden');

                setTimeout(() => {
                    alertBox.classList.add('hidden');
                    alertText.textContent = '';
                }, 4000);
            }

            function handleError(err, fallback = 'Unexpected error') {
                const msg = err?.response?.data?.error || err?.message || fallback;
                showAlert(msg);
            }

            // 🔄 Load initial history
            try {
                const res = await axios.get(`${apiUrl}/token/${token}/game/history`);
                const lastThree = res.data?.data?.slice?.(0, 3) ?? [];
                renderHistory(lastThree);
            } catch (err) {
                handleError(err, 'Failed to load history.');
                historyList.innerHTML = '<li class="text-red-500">Failed to load history.</li>';
            }

            // 🧩 Generate new link
            document.getElementById('generateLinkBtn').addEventListener('click', async () => {
                try {
                    const response = await axios.post(`${apiUrl}/token/${token}`);
                    if (!response.data.success) {
                        throw new Error(response.data.error || 'Failed to generate link.');
                    }

                    const link = `{{ env('APP_URL') }}/a/${response.data.data}`;
                    linkOutput.innerHTML = `<span class="text-green-600">New Link:</span> <a href="${link}" class="underline text-blue-600">${link}</a>`;
                } catch (err) {
                    handleError(err, 'Link generation error.');
                }
            });

            // ❌ Deactivate link
            document.getElementById('deactivateLinkBtn').addEventListener('click', async () => {
                try {
                    const response = await axios.patch(`${apiUrl}/token/${token}`);
                    if (!response.data.success) {
                        throw new Error(response.data.error || 'Failed to deactivate link.');
                    }

                    linkOutput.innerHTML = `<span class="text-red-600">Link deactivated.</span>`;
                } catch (err) {
                    handleError(err, 'Deactivation error.');
                }
            });

            // 🎰 Lucky game
            document.getElementById('luckyBtn').addEventListener('click', async () => {
                try {
                    const response = await axios.post(`${apiUrl}/token/${token}/game`);
                    if (!response.data.success) {
                        throw new Error(response.data.error || 'Game failed.');
                    }

                    const { generated_number, result, prize } = response.data.data;
                    const isWin = result.toLowerCase() === 'win';

                    luckyResult.innerHTML = `
                        🎲 Number: <strong>${generated_number}</strong><br>
                        🎯 Result: <strong class="${isWin ? 'text-green-600' : 'text-red-600'}">${result}</strong><br>
                        💰 ${isWin ? `You won: <strong>${prize}</strong>` : 'No winnings this time.'}
                    `;

                    const historyRes = await axios.get(`${apiUrl}/token/${token}/game/history`);
                    renderHistory(historyRes.data.data?.slice?.(0, 3) ?? []);
                } catch (err) {
                    handleError(err, 'Game error.');
                }
            });

            // ⏪ Render history
            function renderHistory(data = []) {
                if (!data.length) {
                    historyList.innerHTML = '<li class="text-gray-400">No history yet.</li>';
                    return;
                }

                historyList.innerHTML = '';
                data.forEach((item, index) => {
                    const isWin = item.result.toLowerCase() === 'win';
                    historyList.innerHTML += `
                        <li>
                            Try #${index + 1}: 🎲 ${item.generated_number}
                            — <span class="${isWin ? 'text-green-600' : 'text-red-600'}">${item.result}</span>
                            ${isWin ? `— 💰 ${item.prize}` : ''}
                        </li>
                    `;
                });
            }
        });
    </script>

@endsection
