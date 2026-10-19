<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <section class="md:col-span-3">
            <div class="rounded-lg shadow-md bg-white p-3">
                <div class="flex justify-between items-center">
                    <a
                        class="block p-4 text-blue-700"
                        href="{{route('jobs.index')}}"
                    >
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        Back To Listings
                    </a>
                    @can('update', $job)

                    <div class="flex space-x-3 ml-4">
                        <a
                            href="{{route('jobs.edit', $job)}}"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                        >Edit</a
                        >
                        <!-- Delete Form -->
                        <form method="POST" action="{{route('jobs.destroy', $job)}}" onsubmit="return confirm('Are you sure, that you want to delete this job')">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded"
                            >
                                Delete
                            </button>
                        </form>
                        <!-- End Delete Form -->
                    </div>
                    @endcan
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold">
                        {{$job->title}}
                    </h2>
                    <p class="text-gray-700 text-lg mt-2">
                       {{$job->description}}
                    </p>
                    <ul class="my-4 bg-gray-100 p-4">
                        <li class="mb-2">
                            <strong>Job Type:</strong> {{$job->job_type}}
                        </li>
                        <li class="mb-2">
                            <strong>Remote:</strong> {{$job->remote ? 'Yes' : 'No'}}
                        </li>
                        <li class="mb-2">
                            <strong>Salary:</strong> ${{number_format($job->salary)}}
                        </li>
                        <li class="mb-2">
                            <strong>Site Location:</strong> {{$job->city}}, {{$job->state}}
                        </li>
                        <li class="mb-2">
                            <strong>Tags:</strong>
                            {{$job->tags}}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container mx-auto p-4">
                <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                <div class="rounded-lg shadow-md bg-white p-4">
                    <h3
                        class="text-lg font-semibold mb-2 text-blue-500"
                    >
                        Job Requirements
                    </h3>
                    <p>
                       {{$job->requirements}}
                    </p>
                    <h3
                        class="text-lg font-semibold mt-4 mb-2 text-blue-500"
                    >
                        Benefits
                    </h3>
                    <p>
                        {{$job->benefits}}
                    </p>
                </div>
                @auth
                <p class="my-5">
                    Put "Job Application" as the subject of your email
                    and attach your resume.
                </p>
                <div x-data="{open: @js($errors->any())}">
                    <button
                        @click="open = true"
                        class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200 cursor-pointer"
                    >
                        Apply Now
                    </button>
                    <div
                        x-cloak
                        x-show="open"
                        @click.away="open = false"
                        class="fixed inset-0 flex items-center justify-center bg-gray-900/50"
                    >
                        <div class="relative bg-white rounded-lg p-6 shadow-md w-full max-w-md max-h-full overflow-y-scroll">
                            <div
                                @click="open = false"
                                class="absolute right-0.5 top-0.5 flex items-center justify-center p-2 cursor-pointer"
                            >
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <h3 class="text-lg font-semibold mb-4">
                                Apply for {{$job->title}}
                            </h3>
                            <form
                                method="POST"
                                action="{{route('application.store', $job->id)}}"
                                enctype="multipart/form-data"
                            >
                                @csrf
                                <x-inputs.text id="full_name" name="full_name" label="Full Name"/>
                                <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone"/>
                                <x-inputs.text id="contact_email" name="contact_email" label="Contact Email"/>
                                <x-inputs.text-area id="message" name="message" label="Message"/>
                                <x-inputs.text id="location" name="location" label="Location"/>
                                <x-inputs.file id="resume" name="resume" label="Upload Your Resume (.pdf)"/>
                                <button
                                    type="submit"
                                    class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"
                                >
                                    Submit Application
                                </button>
                                <button
                                    @click="open = false"
                                    class="cursor-pointer bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md"
                                >
                                    Cancel Application
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                    <p class="my-5 flex items-center justify-center bg-gray-200 rounded-lg p-2">
                        <i class="fa fa-info-circle"></i>
                        You must be logged in to apply to job
                    </p>
                @endauth
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <div id="map"></div>
            </div>
        </section>

        <aside class="bg-white rounded-lg shadow-md p-3">
            <h3 class="text-xl text-center mb-4 font-bold">
                Company Info
            </h3>
            <img
                src="/storage/{{$job->company_logo}}"
                alt="{{$job->company_name}}"
                class="w-full rounded-lg mb-4 m-auto"
            />
            <h4 class="text-lg font-bold">{{$job->company_name}}</h4>
            <p class="text-gray-700 text-lg my-3">
                {{$job->company_description}}
            </p>
            <a
                href="{{$job->company_website}}"
                target="_blank"
                class="text-blue-500"
            >Visit Website</a>

            @guest
                <p class="bg-gray-200 rounded-full p-2 text-gray-800 text-xs w-full text-center">
                    <i class="fa fa-circle-info mr-3"></i>
                    You must be logged in to bookmark this job
                </p>
            @else
                <form
                    method="POST"
                    action="{{auth()->user()->bookmarkedJobListings()->find($job->id) ? route('bookmarks.destroy', $job->id) :route('bookmarks.store', $job->id)}}">
                    @csrf
                    @if(auth()->user()->bookmarkedJobListings()->find($job->id))
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white flex items-center justify-center rounded-sm w-full py-3 cursor-pointer hover:bg-red-600">
                            <i class="fas fa-bookmark mr-3"></i> Remove Bookmark
                        </button>
                    @else
                        <button type="submit" class="bg-blue-500 text-white flex items-center justify-center rounded-sm w-full py-3 cursor-pointer hover:bg-blue-600">
                            <i class="fas fa-bookmark mr-3"></i> Bookmark Listing
                        </button>
                    @endif
                </form>
            @endguest
        </aside>
    </div>
</x-layout>
