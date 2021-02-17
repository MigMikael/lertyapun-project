{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lertyapun</title>


    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="container-fluid">
            <h1 class="mt-4">Welcome to Lertyapun Store</h1>
        </div>
    </div>
    <script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>
</html> --}}

@extends('template.customer')

@section('content')
<!-- Masthead -->
<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1>เลิศยาภัณฑ์</h1>
                <p>ร้านยาคุณภาพ สภาเภสัชกรรม</p>
            </div>
        </div>
    </div>
</header>

<!-- Icons Grid -->
<section class="features-icons bg-white text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                    <div class="features-icons-icon d-flex">
                        <i class="icon-check m-auto text-primary"></i>
                    </div>
                    <h3>ร้านยาคุณภาพ</h3>
                    <p class="lead mb-0">ร้านของเราผ่านการรับรองจากสภาเภสัชกรรม ว่ามีมาตรฐานการให้ “บริการด้านยาและสุขภาพที่ดี มีคุณภาพ”</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                    <div class="features-icons-icon d-flex">
                        <i class="icon-layers m-auto text-primary"></i>
                    </div>
                    <h3>บริการให้คำปรึกษาด้านยาและปัญหาสุขภาพ</h3>
                    <p class="lead mb-0">ร้านของเราให้บริการโดยเภสัชกรผู้ได้รับใบอนุญาติประกอบวิชาชีพเภสัชกรรม</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                    <div class="features-icons-icon d-flex">
                        <i class="fa fa-shipping-fast m-auto text-primary"></i>
                    </div>
                    <h3>จัดส่งสินค้าถึงมือคุณ</h3>
                    <p class="lead mb-0">ร้านของเรามีบริการจัดส่งสินค้าทั่วประเทศไทย เราใส่ใจในทุกกระบวนการ เพื่อให้คุณได้รับการบริการอย่างดีที่สุด</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Showcases -->
<section class="showcase">
    <div class="container-fluid p-0">
        <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/drug.jpg');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>ร้านยาคุณภาพ</h2>
                <p class="lead mb-2">
                    ร้านยาคุณภาพ มีการบริการที่เน้นการบริการแบบวิชาชีพทั้งในส่วนของผลิตภัณฑ์ (Product service) และในส่วนของบริการข้อมูลและข้อแนะนำ (Information service)</p>
                    <p class="lead mb-2">ร้านยาคุณภาพที่ผ่านการรับรองจากสภาเภสัชกรรมแล้ว จะให้บริการที่ดี มีคุณภาพ ในมาตรฐาน 5 ด้าน คือ</p>
                    <ol class="lead mb-0">
                        <li>ด้านสถานที่ อุปกรณ์ และสิ่งสนับสนุนบริการ</li>
                        <li>ด้านการบริหารจัดการเพื่อคุณภาพ</li>
                        <li>ด้านการบริการเภสัชกรรมที่ดี</li>
                        <li>ด้านการปฏิบัติตามกฎ ระเบียบ และจริยธรรมจรรยาบรรณทางวิชาชีพ</li>
                        <li>ด้านการมีส่วนร่วมในชุมชน และสังคม</li>
                    </ol>
                </p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/health.jpg');"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>บริการให้คำปรึกษาด้านยาและปัญหาสุขภาพ</h2>
                <p class="lead mb-2">ร้านของเราให้บริการโดยเภสัชกรผู้ได้รับใบอนุญาติประกอบวิชาชีพเภสัชกรรม เราใส่ใจในการใช้ยาให้มีคุณภาพ เหมาะสม และปลอดภัย เราพร้อมให้คำปรึกษาทางด้านยาและปัญหาสุขภาพ
                </p>
                <p class="lead mb-0">
                ร้านของเรายังจัดกิจกรรมตรวจสุขภาพฟรีตลอดทั้งปี โดยได้รับความร่วมมือจากหน่วยงานและบริษัทต่างๆเพื่อดูแลสุขภาพของคุณอย่างดีที่สุด
                </p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/delivery.jpg');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>จัดส่งสินค้าถึงมือคุณ</h2>
                <p class="lead mb-0">ร้านของเรามีบริการจัดส่งสินค้าทั่วประเทศไทย เราตั้งใจส่งมอบสินค้าที่ดี มีคุณภาพและปลอดภัย เพื่อให้คุณได้ใช้ชีวิตประจำวันอย่างเต็มที่และมีคุณภาพ เราใส่ใจในทุกกระบวนการส่งมอบสินค้า เพื่อให้คุณได้รับการบริการอย่างดีที่สุด</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials text-center bg-white">
    <div class="container">
        <h2 class="mb-5">บุคลากรของเรา</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="img/mix.jpg" alt="">
                    <h5>พลาพล บรรจงคชาธาร</h5>
                    <p class="font-weight-light mb-0">เภสัชศาสตรบัณฑิต (ภ.บ.)<br>วิทยาลัยเภสัชศาสตร์ มหาวิทยาลัยรังสิต</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="img/man.jpg" alt="">
                    <h5>พลาเลิศ บรรจงคชาธาร</h5>
                    <p class="font-weight-light mb-0">บริหารธุรกิจบัณฑิต (บธ.บ)<br>คณะบริหารธุรกิจ มหาวิทยาลัยรังสิต</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="img/mint.jpg" alt="">
                    <h5>พลาพร บรรจงคชาธาร</h5>
                    <p class="font-weight-light mb-0">กำลังศึกษาคณะเภสัชศาสตร์<br>มหาวิทยาลัยหัวเฉียวเฉลิมพระเกียรติ</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h2 class="mb-4">พร้อมจะร่วมเป็นพาร์ทเนอร์กับเราแล้วหรือยัง สมัครเลย !</h2>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <form>
                    <div class="form-row">
                        <div class="col-md-8">
                            <input type="email" class="form-control form-control-lg form-group" placeholder="Enter your email...">
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url('register') }}" class="btn btn-block btn-lg btn-primary form-group">สมัครสมาชิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                <ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <a href="#">About</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#">Contact</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#">Terms of Use</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#">Privacy Policy</a>
                    </li>
                </ul>
                <p class="text-muted small mb-4 mb-lg-0">&copy; LERTYAPHAN 2020. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-3">
                        <a href="#">
                        <i class="fab fa-facebook fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#">
                        <i class="fab fa-twitter-square fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                        <i class="fab fa-instagram fa-2x fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
@endsection
