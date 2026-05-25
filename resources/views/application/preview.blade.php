<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">Application Preview</h2>

                @if($application->admin_comment)

                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded mt-6">

                        <strong>Admin Comment:</strong>

                        <p class="mt-2">
                            {{ $application->admin_comment }}
                        </p>

                    </div>

                @endif


                <div class="space-y-4">
                    @if($application->passport)
                      <img src="{{ asset('storage/' . $application->passport) }}"
                      class="w-32 h-32 object-cover rounded mb-4">
                    @endif
                    <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
                    <p><strong>APP_NO:</strong> {{$application->application_number}}</p>
                    <p><strong>Phone:</strong> {{ $application->phone }}</p>
                    <p><strong>Gender:</strong> {{ $application->gender }}</p>
                    <p><strong>Date of Birth:</strong> {{ $application->dob }}</p>
                    <p><strong>Address:</strong> {{ $application->address }}</p>
                    <p><strong>School:</strong> {{ $application->school }}</p>
                    <p><strong>Qualification:</strong> {{ $application->qualification }}</p>
                    <p><strong>CGPA:</strong> {{ $application->cgpa ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> <span class="px-3 py-1 rounded text-sm
                                @if($application->status === 'approved') bg-green-100 text-green-700
                                @elseif($application->status === 'rejected') bg-red-100 text-red-700
                                @elseif($application->status === 'under_review') bg-yellow-100 text-yellow-700
                                @elseif($application->status === 'submitted') bg-blue-100 text-blue-700
                                @else bg-gray-100 text-gray-700
                                @endif
                            ">
                                {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                    </span></p>
                </div>

                <form method="POST" action="{{ route('application.submit', $application) }}" class="mt-8">
                    @csrf

                    @if($application->status == 'submitted')
                    <span class="bg-green-100 text-green-700 px-6 py-3 rounded mr-3">
                         Application Submitted
                    </span>

                    <a href="{{ route('application.pdf', $application) }}"
                         class="bg-red-500 text-white px-6 py-3 rounded">
                          Download PDF
                    </a>
                    @else
                    <a href="{{ route('application.edit', $application) }}"
                         class="bg-gray-200 px-6 py-3 rounded mr-3">
                         Edit Application
                    </a>
                    <button type="submit" class="bg-black text-white px-6 py-3 rounded">
                        Final Submit
                    </button>
                    @endif

                    

                    <a href="{{ route('application.create') }}" class="ml-4 text-gray-600">
                        Go Back
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>