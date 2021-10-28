<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="{{ route('page.index', 'tentangkami') }}" target="_blank">{{ __('Tentang Kami') }}</a>
                    </li>
                    <li>
                        <a href="https://sman2balikpapan.sch.id/" target="_blank">{{ __('Sekolah') }}</a>
                    </li>
                    <li>
                        <a href="http://itk.ac.id/" target="_blank">{{ __('Kampus') }}</a>
                    </li>
                    <li>
                        <a href="https://www.creative-tim.com/license" target="_blank">{{ __('Licenses') }}</a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>{{ __(', made with ') }}<i class="fa fa-heart heart"></i>{{ __(' by ') }}<a class="@if(Auth::guest()) text-white @endif" href="{{ route('page.index', 'tentangkami') }}" target="_blank">{{ __('Kel.2-KPPL') }}</a>{{ __(' IS-ITK Students') }}
                </span>
            </div>
        </div>
    </div>
</footer>