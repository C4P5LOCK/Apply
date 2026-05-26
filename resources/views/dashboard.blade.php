<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-4">My Dashboard</h2>

                @if(!$application)
                    <p class="mb-4">You have not started your application yet.</p>

                    <a href="{{ route('application.create') }}"
                       class="inline-block bg-black text-white px-6 py-3 rounded">
                        Start Application
                    </a>
                @else
                    <p class="mb-4">
                        Application Status:
                        <strong>{{ ucfirst($application->status) }}</strong>
                    </p>

                    <a href="{{ route('application.preview', $application) }}"
                       class="inline-block bg-black text-white px-6 py-3 rounded">
                        View Application
                    </a>
                @endif

            </div>

            <div class="mt-8">

    <h3 class="text-xl font-bold mb-4">
        Activity Timeline
    </h3>

    @foreach($application->logs as $log)

        <div class="border-l-4 border-black pl-4 mb-4">

            <p class="font-bold">
                {{ ucfirst(str_replace('_', ' ', $log->action)) }}
            </p>

            <p class="text-gray-600">
                {{ $log->description }}
            </p>

            <p class="text-sm text-gray-400">
                {{ $log->created_at->diffForHumans() }}
            </p>

        </div>

    @endforeach

</div>

        </div>
    </div>
</x-app-layout>