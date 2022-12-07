@extends('layouts.app')

@section('title', 'Головна')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Каталог</h2>

            <ul class="list-unstyled">
                @foreach($sections as $section)
                    @if($section->subsection_id == null)
                        <li>
                            <a class="fw-bold"
                               data-bs-toggle="collapse"
                               href="#collapse{{ $section->id }}"
                               role="button"
                               aria-expanded="false"
                               aria-controls="collapse{{ $section->id }}">
                                {{ $section->title }}
                                <ul class="list-unstyled collapse" id="collapse{{ $section->id }}">
                                    @foreach(\App\Models\Section::where('subsection_id', $section->id)->get() as $subsection)
                                        <li>
                                            <a href="/goods?section={{ $subsection->id }}">
                                                {{ $subsection->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="col-9">
            <h1>Content</h1>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mollis mi eget viverra luctus. Curabitur ac justo ac purus sagittis cursus. Sed imperdiet luctus justo, in lacinia libero convallis eu. Suspendisse magna urna, facilisis in porta eu, elementum a dolor. Sed ut justo ex. Ut a bibendum purus, sit amet euismod enim. Vivamus magna dolor, elementum quis consectetur nec, vestibulum nec ligula.

                Curabitur et viverra ligula, sit amet volutpat est. Vivamus suscipit tortor at quam ultricies suscipit. Phasellus ut iaculis neque. Phasellus cursus maximus vulputate. Sed sit amet purus consequat, lobortis velit sed, congue lorem. Donec ligula ex, suscipit sed enim ut, convallis hendrerit ipsum. Maecenas semper magna et viverra euismod. Etiam consequat nisi vel lorem malesuada, a interdum sapien interdum. Donec cursus auctor semper. Quisque at leo vitae nunc molestie venenatis. Donec vulputate nulla ut ligula molestie cursus. Mauris eleifend semper neque nec tincidunt. Cras id pulvinar turpis.

                Vestibulum feugiat arcu lacus, nec sollicitudin elit consectetur eu. Pellentesque consequat eu mi id hendrerit. Aliquam nulla ipsum, commodo sagittis scelerisque volutpat, imperdiet sed dolor. Donec non quam neque. Nam ut rhoncus urna, eu luctus dolor. Aenean fermentum, tellus euismod dictum feugiat, nunc nisi faucibus ipsum, nec faucibus eros est et felis. Vestibulum pulvinar urna nec magna vestibulum cursus. Suspendisse potenti. Donec ac libero vel metus lacinia vestibulum ut ac nisl.

                Quisque ut fermentum erat. Nulla in iaculis metus. Fusce ut blandit tellus. Aliquam commodo rhoncus ex, quis commodo erat varius sit amet. Nullam aliquam nibh laoreet, maximus purus non, vulputate tortor. Nunc ut diam aliquam, ornare augue ut, laoreet nisi. Fusce augue urna, accumsan eu orci a, congue ultricies justo. Suspendisse pretium elit eget ipsum vehicula varius. Vestibulum interdum molestie ipsum, et vestibulum lectus dapibus vel. Maecenas posuere est vel libero venenatis, et semper justo efficitur. Proin auctor sodales odio, sit amet hendrerit tortor. Phasellus eleifend felis elit, non mattis lorem commodo sed.

                Nunc ut leo vitae massa vehicula vehicula sit amet eget nibh. Etiam cursus id massa et rutrum. Pellentesque aliquam sit amet nibh at scelerisque. Nunc arcu arcu, vulputate quis dolor sed, ultricies rutrum ligula. Nam pellentesque aliquet lacinia. Nullam nec nisi eros. Donec ac diam condimentum, aliquet est vitae, aliquet leo. Suspendisse vitae ante mattis, ullamcorper ligula quis, blandit ligula. Sed diam arcu, tincidunt a varius vitae, lobortis a ex. In at elit sit amet neque blandit volutpat vel sit amet eros.</p>
        </div>
    </div>
</div>
@endsection
