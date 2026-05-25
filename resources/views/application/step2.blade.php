<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">Step 2: Academic Information</h2>

                <div class="mb-6">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="font-bold text-black">Personal Info</span>
                        <span class="text-gray-500"><strong>Academic Info</strong></span>
                        <span class="text-gray-500">Uploads</span>
                        <span class="text-gray-500">Preview</span>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-black h-2 rounded-full" style="width: 50%"></div>
                    </div>
                </div>
                <form method="POST" action="{{ route('application.step2.store', $application) }}">
                    @csrf

                    <div class="grid grid-cols-1 gap-4">
                        <input type="text" name="school" placeholder="School" class="border rounded p-3">

                        <input type="text" name="qualification" placeholder="Qualification" class="border rounded p-3">

                        <input type="text" name="cgpa" placeholder="CGPA" class="border rounded p-3">

                        <button class="bg-black text-white p-3 rounded">
                            Continue to Uploads
                        </button>
                    </div>
                    
                </form>
<a href="{{ route('application.step1') }}" class="text-gray-600 mr-4">
    Back
</a>
            </div>
        </div>
    </div>
</x-app-layout>