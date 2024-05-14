<div class="nav-bar">
    <div class="logo">
        <p>@lang('auth.title')</p>
    </div>
    <div class="list-content">
        <ul>
            <li><a href="#">@lang('messages.Home')</a></li>
            <li><a href="#">@lang('messages.Login')</a></li>
            <li><a href="#">@lang('messages.Register')</a></li>
            <li><a href="#">@lang('messages.About-us')</a></li>
            <li><a href="#">@lang('messages.Testimonials')</a></li>
            <li><a href="#">@lang('messages.Why-us')</a></li>
            <li><a href="#">@lang('messages.Contact-us')</a></li>
            <li class="language-dropdown">
                <div class="dropdown">
                    <button class="dropbtn">{{ app()->getLocale() == 'ar' ? 'العربية':'English' }}</button>
                    <div class="dropdown-content">
                        <a href="{{ url(app()->getLocale() == 'ar' ? 'en ':'ar') }}">{{ app()->getLocale() == 'ar' ? 'English ':'العربية' }}</a>
                        {{-- <a href="{{ url('ar') }}">Arabic</a> --}}
                        <!-- Add more languages as needed -->
                    </div>
                </div>
            </li>
            <div class="clear-fix"></div>

        </ul>
    </div>
</div>


