<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        <h2 class="text-2xl font-bold mb-6">
            Application Form
        </h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('application.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-4">

                <input type="text" name="full_name"
                    placeholder="Full Name"
                    class="border rounded p-3">

                <input type="text" name="phone"
                    placeholder="Phone"
                    class="border rounded p-3">

                <select name="gender" class="border rounded p-3">
                    <option value="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>

                <input type="date" name="dob"
                    class="border rounded p-3">

                <textarea name="address"
                    placeholder="Address"
                    class="border rounded p-3"></textarea>

                <input type="text" name="school"
                    placeholder="School"
                    class="border rounded p-3">

                <input type="text" name="qualification"
                    placeholder="Qualification"
                    class="border rounded p-3">

                <input type="text" name="cgpa"
                    placeholder="CGPA"
                    class="border rounded p-3">

                <input type="file" name="passport" class="border rounded p-3">
                
                <button class="bg-black text-white p-3 rounded">
                    Submit Application
                </button>

            </div>
        </form>
    </div>
</x-app-layout>