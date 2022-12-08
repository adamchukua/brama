@extends('layouts.app')

@section('title', 'Доставка')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Зміст</h2>

            <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link" href="#item-1">Хочу зробити замовлення. Коли його зможуть доставити?</a>
                    <nav class="nav nav-pills flex-column">
                        <a class="nav-link ms-3 my-1" href="#item-1-1">Самовивіз</a>
                        <a class="nav-link ms-3 my-1" href="#item-1-2">Нова пошта</a>
                        <a class="nav-link ms-3 my-1" href="#item-1-3">Укрпошта</a>
                        <a class="nav-link ms-3 my-1" href="#item-1-4">Інші поштові сервіси</a>
                    </nav>
                </nav>
            </nav>
        </div>

        <div class="col-9">
            <h1 class="fw-bolder mb-3">Доставка</h1>

            <div data-bs-spy="scroll" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
                <div id="item-1">
                    <h4>Хочу зробити замовлення. Коли його зможуть доставити?</h4>

                    <p>При купівлі товару в Brama ми гарантуємо запебзечення права споживачів при придбанні непродовольчого товару належної якості:</p>
                </div>

                <div id="item-1-1">
                    <h5>Самовивіз</h5>

                    <p>Найшвидший спосіб отримання це самовивіз з наших складів. З причин безпеки ми не публікуємо точки видачі до кінця воєнного стану. Щоб скористатись самовивозом зверніться в гарячу лінію 24/7: 0800 300 000.</p>
                </div>

                <div id="item-1-2">
                    <h5>Нова пошта</h5>

                    <p>Ознайомтесь з <a href="https://static.novaposhta.ua/sitecard/misc/doc/%D0%A8%D0%B2%D0%B8%D0%B4%D0%BA%D1%96%D1%81%D1%82%D1%8C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B8%20%D1%82%D1%80%D0%B0%D0%B2%D0%B5%D0%BD%D1%8C%202022.pdf">"Швидкість доставки між обласними центрами "відділення-відділення"
                            для відправлень до 30кг (П,ДВ) з понеділка по суботу"</a></p>
                </div>

                <div id="item-1-3">
                    <h5>Укрпошта</h5>

                    <p>Ознайомтесь з <a href="https://www.ukrposhta.ua/ua/terminy-ukrposhta-ekspres">"Терміни доставки відправлень «Укрпошта Експрес» та «Укрпошта Документи»"</a></p>
                </div>

                <div id="item-1-4">
                    <h5>Інші поштові сервіси</h5>

                    <p>Якщо у Вас немає можливості отримати замовлення самовивозом, Укр чи Новою поштою - зверніться в гарячу лінію 24/7: 0800 300 000. Ми знайдемо зручний для вас шлях доставки. Врахуйте, що термін доставки при цьому - нестандартизований.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
