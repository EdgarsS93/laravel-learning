<form method="POST" action="{{route('logout')}}">
   @csrf
    <button type="submit" class="text-white cursor-pointer hover:underline">
        <i class="fa fa-sign-out mr-1"></i> Logout
    </button>
</form>
