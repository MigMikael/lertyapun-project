@extends('template.customer')

@section('content')
<!-- Masthead -->
<header class="masthead text-white text-center bg-landing-page" style="margin-top: 0px !important;">
    <div class="masthead-overlay"></div>
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
                    <p class="lead mb-0">ร้านของเราผ่านการรับรองจากสภาเภสัชกรรม ว่ามีมาตรฐานการให้ บริการด้านยาและสุขภาพที่ดี มีคุณภาพ</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                    <div class="features-icons-icon d-flex">
                        <i class="icon-layers m-auto text-primary"></i>
                    </div>
                    <h3>บริการให้คำปรึกษาด้านยา</h3>
                    <p class="lead mb-0">ร้านของเราให้บริการโดยเภสัชกรผู้ได้รับใบอนุญาติประกอบวิชาชีพเภสัชกรรม พร้อมให้คำปรึกษาอย่างมีคุณภาพ</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                    <div class="features-icons-icon d-flex">
                        <i class="fa fa-shipping-fast m-auto text-primary"></i>
                    </div>
                    <h3>บริการจัดส่งฟรี</h3>
                    <p class="lead mb-0">จัดส่งฟรีเมื่อสั่งซื้อขั้นต่ำ 7,500 บาท พื้นที่ห่างไกลคิดเพิ่มเพียง 100 บาท ให้บริการโดย Kerry / Flash Express</p>
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
                <h2>บริการให้คำปรึกษาด้านยา</h2>
                <p class="lead mb-2">ร้านของเราให้บริการโดยเภสัชกรผู้ได้รับใบอนุญาติประกอบวิชาชีพเภสัชกรรม เราใส่ใจในการใช้ยาให้มีคุณภาพ เหมาะสม และปลอดภัย
                </p>
                <p class="lead mb-0">
                ร้านของเรายังจัดกิจกรรมตรวจสุขภาพฟรีตลอดทั้งปี โดยได้รับความร่วมมือจากหน่วยงานและบริษัทต่างๆเพื่อดูแลสุขภาพของคุณอย่างดีที่สุด
                </p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/delivery.jpg');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>บริการจัดส่งฟรี</h2>
                <p class="lead mb-2">ร้านของเรามีบริการจัดส่งสินค้าทั่วประเทศไทย เราตั้งใจส่งมอบสินค้าที่ดี มีคุณภาพและปลอดภัย เพื่อให้คุณได้ใช้ชีวิตประจำวันอย่างเต็มที่และมีคุณภาพ</p>
                <p class="lead mb-0">บริการจัดส่งฟรีเมื่อสั่งซื้อขั้นต่ำ 7,500 บาท พื้นที่ห่างไกลคิดเพิ่มเพียง 100 บาท ให้บริการโดยบริษัทขนส่งเอกชนชั้นนำ Kerry / Flash Express เป็นขนส่งหลัก</p>
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
                    <p class="font-weight-light mb-0">กำลังศึกษาคณะเภสัชศาสตร์<br>มหาวิทยาลัยศิลปากร</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="call-to-action text-white text-center">
    <div class="call-to-action-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h2 class="mb-4">ร่วมเป็นพาร์ทเนอร์กับเรา</h2>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <form method="GET" action="{{ url('register') }}">
                    <div class="form-row">
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control form-control-lg form-group" placeholder="กรอกอีเมล์ของท่าน...">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-block btn-lg btn-primary form-group">สมัครสมาชิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="testimonials text-center bg-white" id="contactUs">
    <div class="container">
        <h2 class="mb-5">ติดต่อเรา</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-box" style="min-height: 250px;">
                    <h5 class="mb-3"><i class="fas fa-map-marker-alt text-primary"></i> ที่อยู่</h5>
                    <p class="mb-0" style="font-size: 20px;">ร้านเลิศยาภัณฑ์<br>
                    <p style="font-size: 20px;">384-386 ต.ท่าเรือ<br>
                    อ.ท่ามะกา จ.กาญจนบุรี 71130</p>
                </div>
            </div>
            <!--
            <div class="col-lg-4">
                <div class="contact-box">
                    <h5 class="mb-3"><i class="fas fa-phone-alt text-primary"></i> เบอร์โทรศัพท์</h5>
                    <p>034-561-128<br>
                    095-254-4525</p>
                </div>
            </div>
            -->
            <div class="col-lg-4">
                <div class="contact-box" style="min-height: 250px;">
                    <h5 class="mb-3"><i class="fas fa-clock text-primary"></i> เวลาเปิดทำการ</h5>
                    <p class="mb-0" style="font-size: 20px;">จันทร์ - ศุกร์ : 7.30 - 19.00 น</p>
                    <p class="mb-0" style="font-size: 20px;">เสาร์ : 7.30 - 12.00 น.</p>
                    <p style="font-size: 20px;">อาทิตย์ : 7.30 - 19.00 น.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-box" style="min-height: 250px;">
                    <h5><i class="fab fa-facebook" style="color: #1b74e4;"></i> Facebook</h5>
                    <p class="mb-0" style="font-size: 20px;"><a href="https://www.facebook.com/Lertyaphan" target="_blank">facebook.com/Lertyaphan</a></span></p>
                    <img src="https://i.ibb.co/nCgL9GV/fb.png" alt="fb" style="height: 120px;">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-box" style="min-height: 250px;">
                    <h5><i class="fab fa-line" style="color: green"></i> ร้านยา / ขายส่ง</h5>
                    <p class="mb-0" style="font-size: 20px;">@lertyaphan <span>(มี @ นำหน้า)</span></p>
                    <p class="mb-0" style="font-size: 20px;">โทร 095-254-4525</p>
                    <img src="https://i.ibb.co/27q6ftx/line.png" alt="line" style="height: 120px;">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-box" style="min-height: 250px;">
                    <h5><i class="fab fa-line" style="color: green"></i> สอบถามข้อมูลยา ราคาสินค้า เพิ่มเติมได้ที่</h5>
                    <p class="mb-0" style="font-size: 20px;">@lyp007 <span>(มี @ นำหน้า)</span></p>
                    <p class="mb-0" style="font-size: 20px;">โทร 034-561128</p>
                    <img src="https://i.ibb.co/2qJBv2T/294633317-1997034553815507-3499732937996048111-n.png" alt="line" style="height: 120px;">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15487.95385446088!2d99.7493389!3d13.9592923!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1bf9da5c69b0339!2z4Lij4LmJ4Liy4LiZ4LiC4Liy4Lii4Lii4Liy4LmA4Lil4Li04Lio4Lii4Liy4Lig4Lix4LiT4LiR4LmMIOC4o-C5ieC4suC4meC4ouC4suC4o-C4suC4hOC4suC4luC4ueC4gSDguJvguKXguLXguIEt4Liq4LmI4LiH!5e0!3m2!1sen!2sth!4v1622018400472!5m2!1sen!2sth" width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="border:0;" allowfullscreen="" loading="lazy" ></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted text-center" style="margin-top: 5px; margin-bottom: 0px !important;">&copy; LERTYAPHAN <?php echo date("Y"); ?>. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

@endsection
