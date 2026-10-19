<x-layout>
    <div class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4">Login</h2>
        <form method="POST" action="{{route('login.authenticate')}}">
            @csrf
            <x-inputs.text id="email" name="email" type="mail" placeholder="Enter email"/>
            <x-inputs.text id="password" name="password" type="password" placeholder="Enter password"/>

            <button type="submit" class="bg-blue-500 w-full hover:bg-blue-600 tex-white rounded-2xl focus:outline-none text-white px-8 py-6">
                Login
            </button>

            <p class="mt-4 text-center">
                Do not have an account ?
                <a class="text-blue-900" href="{{route('register')}}">Register</a>
            </p>
        </form>
    </div>
</x-layout>
