<x-app-layout>

<div class="py-12">

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white p-8 rounded-lg shadow">

            <h2 class="text-2xl font-bold mb-6">
                Application Details
            </h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($application->passport)

                <img src="{{ asset('storage/' . $application->passport) }}"
                     class="w-32 h-32 object-cover rounded mb-6">

            @endif

            <div class="space-y-4">

                <p><strong>Name:</strong> {{ $application->full_name }}</p>

                <p><strong>APP_NO:</strong> {{$application->application_number}}</p>

                <p><strong>Phone:</strong> {{ $application->phone }}</p>

                <p><strong>School:</strong> {{ $application->school }}</p>

                <p><strong>Qualification:</strong> {{ $application->qualification }}</p>

                <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>

            </div>

            <form method="POST"
                  action="{{ route('admin.application.status', $application) }}"
                  class="mt-8">

                @csrf

                <select name="progress"
                        class="border rounded p-3">

                    <option value="pending" {{ $application->progress === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>


                    <option value="approved" {{ $application->progress === 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>

                    <option value="rejected" {{ $application->progress === 'rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>

                </select>

                <textarea name="admin_comment" class="border rounded p-3 w-full mt-4" rows="4"
                   placeholder="Leave admin comment...">{{ $application->admin_comment }}</textarea>

                <button class="bg-black text-white px-6 py-3 rounded ml-3">
                    Update Progress Status
                </button>


            </form>

        </div>

    </div>

</div>

</x-app-layout>