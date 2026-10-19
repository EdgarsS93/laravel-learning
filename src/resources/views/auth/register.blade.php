<x-layout>
    <div class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4">Register</h2>
        <form method="POST" action="{{route('register.store')}}">
            @csrf
            <x-inputs.text id="name" name="name" placeholder="Full name"/>
            <x-inputs.text id="email" name="email" type="mail" placeholder="Enter email"/>
            <x-inputs.text id="password" name="password" type="password" placeholder="Enter password"/>
            <x-inputs.text id="password_confirmation" name="password_confirmation"  type="password" placeholder="Confirm password"/>

            <button type="submit" class="bg-blue-500 w-full hover:bg-blue-600 tex-white rounded-2xl focus:outline-none text-white px-8 py-6">
                Register
            </button>

            <p class="mt-4 text-center">
                Already have an account?
                <a class="text-blue-900" href="{{route('login')}}">Login!</a>
            </p>
        </form>
    </div>
</x-layout>
