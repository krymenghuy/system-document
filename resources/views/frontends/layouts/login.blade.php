<!-- Modal -->
@if (!session()->has('user_auth'))
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username">username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                {{-- <label for="username">username</label> --}}

                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <label for="password">password</label>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                                <input type="password" name="form-control"class="form-control" required>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary w-100"><i
                                class="fas fa-sign-in-alt"></i>Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
