<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">Step 1: Personal Information</h2>

                <form method="POST" action="{{ route('application.step1.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 gap-4">
                        <input type="text" name="full_name" placeholder="Full Name" class="border rounded p-3">

                        <input type="text" name="phone" placeholder="Phone" class="border rounded p-3">

                        <select name="gender" class="border rounded p-3">
                            <option value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>

                        <input type="date" name="dob" class="border rounded p-3">

                        <textarea name="address" placeholder="Address" class="border rounded p-3"></textarea>

                        <button class="bg-black text-white p-3 rounded">
                            Continue to Academic Info
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>