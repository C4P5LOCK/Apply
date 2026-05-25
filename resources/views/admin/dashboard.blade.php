<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">
                    Admin Dashboard
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">

    <div class="bg-blue-100 p-6 rounded-lg">
        <h3 class="text-sm text-blue-700">Total Applications</h3>
        <p class="text-3xl font-bold mt-2">
            {{ $totalApplications }}
        </p>
    </div>

    <div class="bg-indigo-100 p-6 rounded-lg">
        <h3 class="text-sm text-indigo-700">Submitted</h3>
        <p class="text-3xl font-bold mt-2">
            {{ $submittedApplications }}
        </p>
    </div>

    <div class="bg-yellow-100 p-6 rounded-lg">
        <h3 class="text-sm text-yellow-700">Pending</h3>
        <p class="text-3xl font-bold mt-2">
            {{ $underReviewApplications }}
        </p>
    </div>

    <div class="bg-green-100 p-6 rounded-lg">
        <h3 class="text-sm text-green-700">Approved</h3>
        <p class="text-3xl font-bold mt-2">
            {{ $approvedApplications }}
        </p>
    </div>

    <div class="bg-red-100 p-6 rounded-lg">
        <h3 class="text-sm text-red-700">Rejected</h3>
        <p class="text-3xl font-bold mt-2">
            {{ $rejectedApplications }}
        </p>
    </div>

</div>

//CHART CANVAS
<div class="bg-white p-6 rounded-lg shadow mb-8">
    <h3 class="text-xl font-bold mb-4">Applications by Status</h3>

    <canvas id="statusChart" height="100"></canvas>
</div>
                                <form method="GET"
                    action="{{ route('admin.dashboard') }}"
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
                            <th class="p-3 text-left">Action</th>
                            <th class="p-3 text-left">Verdict</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($applications as $application)

                            <tr class="border-b">

                            <td class="p-3">
                                {{$application->application_number}}
                                </td>

                                <td class="p-3">
                                    {{ $application->full_name }}
                                </td>

                                <td class="p-3">
                                    {{ $application->school }}
                                </td>

                                <td class="p-3">
                                    
                                    <span class="px-3 py-1 rounded text-sm
                                            @if($application->status === 'approved') bg-green-100 text-green-700
                                            @elseif($application->status === 'rejected') bg-red-100 text-red-700
                                            @elseif($application->status === 'under_review') bg-yellow-100 text-yellow-700
                                            @elseif($application->status === 'submitted') bg-blue-100 text-blue-700
                                            @else bg-gray-100 text-gray-700
                                            @endif
                                             ">
                                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                        </span> 
                                </td>

                                <td class="p-3">

                                    @if($application->passport)

                                        <img src="{{ asset('storage/' . $application->passport) }}"
                                             class="w-16 h-16 object-cover rounded">

                                    @endif

                                </td>
                                
                                <td class="p-3">
                                    
                                    <a href="{{ route('admin.application.show', $application) }}"
                                         class="bg-black text-white px-4 py-2 rounded">
                                        View
                                    </a>

                                </td>

                                <td class="p-3">
                                    {{ucfirst($application->progress)}}
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('statusChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Submitted', 'Pending', 'Approved', 'Rejected'],
            datasets: [{
                label: 'Applications',
                data: [
                    {{ $submittedApplications }},
                    {{ $underReviewApplications }},
                    {{ $approvedApplications }},
                    {{ $rejectedApplications }}
                ]
            }]
        }
    });
</script>

</x-app-layout>