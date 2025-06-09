@extends('layout.base')
@section('content')

    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-md p-8 space-y-6">
            <h1 class="text-2xl font-bold text-center text-gray-800">Register</h1>

            <div id="successMessage" class="hidden text-green-600 text-center text-sm"></div>
            <div id="errorMessage" class="hidden text-red-600 text-center text-sm"></div>

            <form id="registrationForm" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" required
                           class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required
                           class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none">
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
                    Register
                </button>
            </form>
        </div>
    </div>



    <script type="module">


        document.addEventListener('DOMContentLoaded', () => {
            const axios = window.axios;

            const form = document.getElementById('registrationForm');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            form?.addEventListener('submit', async (e) => {
                e.preventDefault();

                const name = document.getElementById('name').value;
                const phone = document.getElementById('phone').value;

                try {
                    const response = await axios.post(`{{ env('APP_URL') }}/api/registration`, {
                        name: name,
                        phone_number: phone,
                    });

                    if (response.data.success) {
                        location.href = `{{ env('APP_URL') }}/a/${response.data.data}`;
                    } else {
                        throw new Error('Unexpected response');
                    }
                } catch (error) {
                    errorMessage.textContent = 'Registration failed. Please try again.';
                    errorMessage.classList.remove('hidden');
                    successMessage.classList.add('hidden');
                }
            });
        });
    </script>


@endsection
