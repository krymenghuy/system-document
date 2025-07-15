<div class="container mt-3">
    <!-- Header Section -->
    <header class=" text-black header d-flex justify-content-between align-items-center mb-4">
      <!-- Logo on the left -->
      <a href="#" class="logo h3  text-decoration-none text-Dark"> MENAGEMENT DOCUMENT </a>

     

      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle bg-purple" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
            ENGLISH
        </button>
        @if(!session()->has('user_auth'))
      <a href="{{ route('login') }}" class="btn btn-outline-primary ms-auto  btn-Light">Login</a>
      @endif
    </div>
    </header>
</div>
     


    
    