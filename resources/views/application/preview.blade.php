<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">Application Preview</h2>

                <div class="space-y-4">
                    @if($application->passport)
                      <img src="{{ asset('storage/' . $application->passport) }}"
                      class="w-32 h-32 object-cover rounded mb-4">
                    @endif
                    <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
                    <p><strong>Phone:</strong> {{ $application->phone }}</p>
                    <p><strong>Gender:</strong> {{ $application->gender }}</p>
                    <p><strong>Date of Birth:</strong> {{ $application->dob }}</p>
                    <p><strong>Address:</strong> {{ $application->address }}</p>
                    <p><strong>School:</strong> {{ $application->school }}</p>
                    <p><strong>Qualification:</strong> {{ $application->qualification }}</p>
                    <p><strong>CGPA:</strong> {{ $application->cgpa ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
                </div>

                <form method="POST" action="{{ route('application.submit', $application) }}" class="mt-8">
                    @csrf

                    @if($application->status == 'submitted')
                    <span class="bg-green-100 text-green-700 px-6 py-3 rounded mr-3">
                         Application Submitted
                    </span>
                    @else
                    <a href="{{ route('application.edit', $application) }}"
                         class="bg-gray-200 px-6 py-3 rounded mr-3">
                         Edit Application
                    </a>
                    @endif

                    <!-- <button type="submit" class="bg-black text-white px-6 py-3 rounded">
                        Final Submit
                    </button> -->

                    <a href="{{ route('application.create') }}" class="ml-4 text-gray-600">
                        Go Back
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>