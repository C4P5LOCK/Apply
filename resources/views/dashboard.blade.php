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
        </div>
    </div>
</x-app-layout>