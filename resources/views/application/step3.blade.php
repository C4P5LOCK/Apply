<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">Step 3: Upload Passport</h2>

                <form method="POST"
                      action="{{ route('application.step3.store', $application) }}"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="passport" class="border rounded p-3 w-full">

                    <button class="bg-black text-white p-3 rounded mt-4">
                        Preview Application
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>