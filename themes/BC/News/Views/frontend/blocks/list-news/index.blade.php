<div class="bravo-list-news">
    <div class="container">
        @if($title)
        <div class="title">
            {{$title}}
            @if(!empty($desc))
            <div class="sub-title">
                {{$desc}}
            </div>
            @endif
        </div>
        @endif
        <div class="list-item">
            <div class="row">
                @foreach($rows as $row)
                <div class="col-lg-4 col-md-6">
                    @include('News::frontend.blocks.list-news.loop')
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- START CUSTOMIZE SECTION 11 --}}
<section class="support" id="support">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img  style="width: 100%;" src="{{ asset('uploads/banner.png') }}"/>
            </div>
            <div class="col-4" style="margin: auto;">
                <div class="content" style="line-height: 4;">
                    <div class="label">Expert and professional support</div>
                </div>
                    <h2>Prepare the name</h2>
                    <p>Why don't we sleep on this? Doesn't it matter if I sleep? Agencija Nomadik Travel je tu da riješi to “Kako?”. Don't worry about putting the program, vizama, kartama, pismima preporuke i sličnim stvarima, mi smo tu da to napravimo za vas. Prepare the name.</p>
                <a class="btn btn-primary" href="http://127.0.0.1:8000/page/customize">Customize</a>
            </div>
        </div>
    </div>
</section>
{{-- END CUSTOMIZE SECTION 11 --}}