@extends('master')

@section('content')
<div class="main-content">
    <div class="container">
        <h1>@lang('messages.Registration From')</h1>
        <form action="" method="post" enctype="multipart/form-data" id="registration-form">
            @csrf
            <div class="form-group" >
                <input id="fname" placeholder="@lang('messages.Full name')" type="text" name="fname" />
                <div class="tooltip">
                    <span class="tooltiptext">Example: Salma Ramadan Mohamed</span>
                </div>

            </div>

            <div class="form-group">
                <input type="text"  id="name" placeholder="@lang('messages.user name')" name="name" {{--onkeyup = "Hints(this.value)"--}}>
                <ul id="suggestions"></ul>
                <div class="tooltip">
                    <span class="tooltiptext">Example: salmaomar_0</span>
                </div>
            </div>

            <div class="form-group">
                <input id="birthdate" placeholder="@lang('messages.birth date')" type="date" name="birthdate"/>
                <div class="tooltip">
                    <span class="tooltiptext">Example: 20-03-2004</span>
                </div>
            </div>
            <div class="form-group">
                <input id="phone" placeholder="@lang('messages.phone')" type="tel"name="phone"/>
                <div class="tooltip">
                    <span class="tooltiptext">Example: + (20) 1101-376-526</span>
                </div>
            </div>
            <div class="form-group">
                <input id="address"placeholder="@lang('messages.address')" type="text" name="address"/>
                <div class="tooltip">
                    <span class="tooltiptext">Example: maadi</span>
                </div>
            </div>
            <div class="form-group">
                <input id="password" placeholder="@lang('messages.password')" type="password" name="password"/>
            </div>
            <div class="form-group">
                <input id="confirm-password" placeholder="@lang('messages.confirm password')" type="password" name="cpassword"/>
            </div>
            <div class="form-group">
                <input id="email" placeholder="@lang('messages.Email')" type="email" name="email"/>
                <div class="tooltip">
                    <span class="tooltiptext">Example: salmaomar@gmail.com</span>
                </div>
            </div>
            <div class="form-group">
                <input type="file" id="photo" name ="photo">
            </div>
            <button class="actors-butt" id="actors-butt">@lang('messages.Show Actors')</button>

            <button class="submit-butt" id="submit-butt">@lang('messages.Submit')</button>
        </form>
    </div>
</div>

<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2></h2>
        <p></p>
    </div>
</div>

<input type="hidden" id="registerRoute" value="{{ route('register.store') }}">
<input type="hidden" id="actorsRoute" value="{{ route('actors') }}">

@endsection

