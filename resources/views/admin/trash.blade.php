<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">
                    Deleted Applicants 
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">

    

</div>


                                <form method="GET"
                    action="{{ route('admin.applications.trash') }}"
                    class="mb-6 flex gap-4">

                    <input type="text"
                        name="search"
                        placeholder="Search name or school"
                        value="{{ request('search') }}"
                        class="border rounded p-3 w-full">

                    <select name="status"
                            class="border rounded p-3">

                        <option value="">All Statuses</option>

                        <option value="submitted"
                            {{ request('status') === 'submitted' ? 'selected' : '' }}>
                            Submitted
                        </option>

                        <option value="under_review"
                            {{ request('status') === 'under_review' ? 'selected' : '' }}>
                            Under Review
                        </option>

                        <option value="approved"
                            {{ request('status') === 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="rejected"
                            {{ request('status') === 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                    </select>

                    <button class="bg-black text-white px-6 rounded">
                        Filter
                    </button>

                </form>
                <a href="{{ route('admin.applications.export') }}"
                    class="inline-block bg-green-600 text-white px-6 py-3 rounded mb-4">
                        Export Excel
                    </a>
                <table class="w-full border">

                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="p-3 text-left">APP NO</th>
                            <th class="p-3 text-left">Name</th>
                            
                            <th class="p-3 text-left">School</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Passport</th>
                            <th class="p-3 text-left">Progress</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($applications as $application)
            <tr class="border-b">
                    <td class="p-3">{{ $application->application_number }}</td>
                
                    <td class="p-3">{{ $application->full_name }}</td>
                    <td class="p-3">{{ $application->school }}</td>
                    <td class="p-3">{{ $application->progress }}</td>
                            <td class="p-3">

                                    @if($application->passport)

                                        <img src="{{ asset('storage/' . $application->passport) }}"
                                             class="w-16 h-16 object-cover rounded">

                                    @endif

                                </td>
              <td class="p-3">{{ ucfirst($application->status) }}</td>

    <td class="p-3 flex gap-2">
        <form method="POST" action="{{ route('admin.application.restore', $application->id) }}">
            @csrf
            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Restore
            </button>
        </form>

        <form method="POST" action="{{ route('admin.application.forceDelete', $application->id) }}">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('Permanently delete this application?')"
                    class="bg-red-600 text-white px-4 py-2 rounded">
                Delete Forever
            </button>
        </form>
    </td>
</tr>
@endforeach

                    </tbody>

                </table>
                    <div class="mt-6">
                        {{ $applications->appends(request()->query())->links() }}
                    </div>
            </div>

        </div>

    </div>



</x-app-layout>