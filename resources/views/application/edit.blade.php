<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">
                    Edit Application
                </h2>

                <form method="POST"
                      action="{{ route('application.update', $application) }}">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">

                        <input type="text"
                               name="full_name"
                               value="{{ $application->full_name }}"
                               class="border rounded p-3">

                        <input type="text"
                               name="phone"
                               value="{{ $application->phone }}"
                               class="border rounded p-3">

                        <select name="gender" class="border rounded p-3">
                            <option value="Male"
                                {{ $application->gender == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Female"
                                {{ $application->gender == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>
                        </select>

                        <input type="date"
                               name="dob"
                               value="{{ $application->dob }}"
                               class="border rounded p-3">

                        <textarea name="address"
                                  class="border rounded p-3">{{ $application->address }}</textarea>

                        <input type="text"
                               name="school"
                               value="{{ $application->school }}"
                               class="border rounded p-3">

                        <input type="text"
                               name="qualification"
                               value="{{ $application->qualification }}"
                               class="border rounded p-3">

                        <input type="text"
                               name="cgpa"
                               value="{{ $application->cgpa }}"
                               class="border rounded p-3">

                        <button class="bg-black text-white p-3 rounded">
                            Update Application
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>