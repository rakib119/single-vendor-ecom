@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile card card-body px-3 pt-3 pb-0">
                        <div class="profile-head">
                            <div class="photo-content">
                                <div class="cover-phot" style="background: url({{ asset('dashboard/uploads/cover_photo') . '/' . Auth::user()->cover_photo }});background-size: cover;
                                            background-position: center;
                                            min-height: 250px;
                                            width: 100%;"></div>
                            </div>
                            <div class="profile-info">
                                <div class="profile-photo">
                                    <img src="{{ asset('dashboard/uploads/profile') . '/' . Auth::user()->profile_photo }}"
                                        class="img-fluid rounded-circle" alt="profile photo">
                                </div>
                                <div class="profile-details">
                                    <div class="profile-name px-3 pt-2">
                                        <h4 class="text-primary mb-0">{{ ucwords(Auth::user()->name) }}</h4>
                                        <p>UX / UI Designer</p>
                                    </div>
                                    <div class="profile-email px-2 pt-2">
                                        <h4 class="text-muted mb-0">{{ strtolower(Auth::user()->email) }}</h4>
                                        <p>Email</p>
                                    </div>
                                    <div class="dropdown ml-auto">
                                        <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown"
                                            aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                    <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                </g>
                                            </svg></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item"><i class="fa fa-user-circle text-primary mr-2"></i>
                                                View profile</li>
                                            <li class="dropdown-item"><i class="fa fa-users text-primary mr-2"></i> Add to
                                                close friends</li>
                                            <li class="dropdown-item"><i class="fa fa-plus text-primary mr-2"></i> Add to
                                                group</li>
                                            <li class="dropdown-item"><i class="fa fa-ban text-primary mr-2"></i> Block
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="card shadow p-3 mb-5 mr-5  bg-white rounded col-md-5 col-lg-5 col-xs-5">
                                <div class="card-body">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary mb-5">Profile Photo</h4>
                                            @if (session('pro_pic_success'))
                                                <div class="alert alert-success">
                                                    <h6>{{ session('pro_pic_success') }}</h6>
                                                </div>
                                            @endif
                                            <form method="POST" enctype="multipart/form-data"
                                                action="{{ route('profile.change_profile_picture') }}">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>Profile Photo <span class="text-danger">*</span></label>
                                                        <input type="file" autocomplete="off" accept=".jpg,.JPG"
                                                            name="profile_photo" class="form-control">
                                                        @error('profile_photo')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Upload</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow p-3 mb-5 bg-white rounded col-md-5 col-lg-5 col-xs-5">
                                <div class="card-body">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary mb-5">Cover Photo</h4>
                                            @if (session('cover_photo_success'))
                                                <div class="alert alert-success">
                                                    <h6>{{ session('cover_photo_success') }}</h6>
                                                </div>
                                            @endif
                                            <form method="POST" enctype="multipart/form-data"
                                                action="{{ route('profile.change_cover_photo') }}">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>Cover Photo <span class="text-danger">*</span></label>
                                                        <input type="file" autocomplete="off" accept=".jpg,.JPG"
                                                            name="cover_photo" class="form-control">
                                                        @error('cover_photo')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Upload</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-3">
                                <div class="settings-form">
                                    <h4 class="text-primary mb-5">Update Profile</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            <h6>{{ session('success') }}</h6>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('profile.update') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                    class="form-control">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Mobile</label>
                                                <input type="text" name="mobile" placeholder="017XXXXXXXX"
                                                    value="{{ Auth::user()->mobile }}" class="form-control">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Address</label>
                                                <input type="text" name="address" value="{{ Auth::user()->address }}"
                                                    placeholder="Village, Thana, District, City" class="form-control">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-3">
                                <div class="settings-form">
                                    <h4 class="text-primary  mb-5">Change Password</h4>
                                    @if (session('password_success'))
                                        <div class="alert alert-success">
                                            <h6>{{ session('password_success') }}</h6>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('profile.changePassword') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Current Password <span class="text-danger">*</span></label>
                                                <input type="text" name="current_password" class="form-control">
                                                @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>New Password <span class="text-danger">*</span></label>
                                                <input type="text" name="password" class="form-control">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Confirm Password <span class="text-danger">*</span></label>
                                                <input type="text" name="password_confirmation" class="form-control">
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
        })
    </script>
@endsection

