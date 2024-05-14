<div class="main-menu menu-fixed menu-light menu-bordered menu-shadow ">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header mb-1 pl-0 bg-white">
                <span data-i18n="nav.category.support">
                    <div class="col-xl-12">
                        <div class="mr-0">
                            <div class="card-body p-0 text-center">
                                @if (empty(Auth::user()->getFirstMedia('foto')))
                                    <img src="{{ asset('master/app-assets/images/gallery/user_profil.png') }}"
                                        alt="avatar" class="rounded-circle height-70">
                                @else
                                    <img src="{{ Auth::user()->getFirstMedia('foto')->getUrl() }}" alt="avatar"
                                        class="rounded-circle height-70">
                                @endif

                                <div class="font-small-4 text-bold-700 p-0 mb-0 black">{!! Auth::user()->name !!}</div>
                                <h3 class="font-small-2 grey darken-3 text-lowercase text-bold-300">
                                    {!! Auth::user()->email !!}<br>
                                </h3>
                            </div>
                        </div>
                    </div>
                </span>
            </li>
            @include('layouts.menu')
        </ul>
    </div>
</div>
