@extends('auth.layouts.app')

@push('extra-css')
    <style>
        .list-group.clear-list .list-group-item{
            border-top: none;
        }
        .list-group-item{
            border: none;
        }
        .list-group-item a {
            color: black;
        }
        .list-group-item a:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')

    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="ibox-content">

            <div style="text-align: center">
                <img alt="image" src="{{ asset('admin/img/logo.png') }}" width="166" />
            </div>

            <h3 class="font-bold">Registration</h3>
            <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <input id="name" type="text" required class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="First Name">
                    @error('name')
                    <span class="help-block m-b-none text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                 <div class="form-group">
                    <input id="last_name" type="text" required class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autocomplete="last_name" autofocus placeholder="Last Name">
                    @error('last_name')
                    <span class="help-block m-b-none text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email">
                    @error('email')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="phone" type="text" required class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="Phone">
                    @error('phone')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" required class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">
                    @error('password')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" required class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm-Password">
                </div>

                <div class="form-group">
                    <select class="form-control" name="department_id">
                        <option value="">Select Faculty</option>
                        @foreach($departments as $department )
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <span class="help-block m-b-none text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <select onchange="checkAccountType(this)" class="form-control" name="account_type_id">
                        <option value="">Account Type</option>
                        <option value="0">Free</option>
                        <option value="1" {{ isset($selected_package) ? 'selected' : '' }}>Paid</option>
                    </select>

                    @error('account_type_id')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div id="packageType" class="form-group {{ (old('account_type_id') == 1) || isset($selected_package) ? '' : 'hidden' }}" >
                    <select class="form-control" name="package_id">
                        <option value="">Select Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ (isset($selected_package) && ($selected_package == $package->slug)) ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('package_id')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group {{ (old('account_type_id') == 1) || isset($selected_package) ? '' : 'hidden' }}" id="paymentType">
                    <select class="form-control" name="payment_type_id">
                        <option value="">Payment Type</option>
                        <option value="1">Online</option>
                        <option value="2">Cash</option>
                    </select>

                    @error('payment_type_id')
                        <span class="help-block m-b-none text-danger">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="i-checks font-normal">
                        <input name="agree" type="checkbox" value="1" required> I have read and agree to the
                    </label>
                    <span class="font-bold" style="cursor: pointer"
                        data-toggle="modal" data-target="#agreeModal">
                        Terms of Service
                    </span>

                    @error('agree')
                        <span class="help-block m-b-none text-danger">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width"><strong>Registration</strong></button>
            </form>

            {{--start polict modal--}}
            <div class="modal inmodal" id="agreeModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header" style="padding: 10px 15px">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="pull-left">Terms of Service</h4>
                        </div>
                        <div class="modal-body" style="padding: 20px">
                            <ul class="list-group clear-list m-b-none">
                                <li class="list-group-item">
                                    <span><i class="fa fa-check"></i> </span>
                                    <a href="https://medmission.com.bd/terms-conditions" target="_blank">Terms & Conditions</a>
                                </li>
                                <li class="list-group-item">
                                    <span><i class="fa fa-check"></i> </span>
                                    <a href="https://medmission.com.bd/privacy-policy-2" target="_blank">Privacy Policy</a>
                                </li>
                                <li class="list-group-item">
                                    <span><i class="fa fa-check"></i> </span>
                                    <a href="https://medmission.com.bd/refund-and-return-policy" target="_blank">
                                        Refund and Return Policy
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--end polict modal--}}

        </div>
    </div>
    <div class="col-sm-2"></div>
@endsection

@section('custom-js')
    <script>
        function checkAccountType(e) {
            let account_type = e.value; // 0 free, 1 paid

            if (account_type == 1){
                $('#paymentType, #packageType').removeClass('hidden');
            }else{
                $('#paymentType, #packageType').addClass('hidden');
            }
        }
    </script>
@endsection
