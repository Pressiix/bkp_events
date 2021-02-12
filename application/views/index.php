<div class="box-social">
  <ul>
    <li><a href="javascript:;" onclick="share_social('facebook', window.location.href);"><img src="<?= $_STATIC_URL ?>assets/images//icon/icn-fb.svg" class="img-fluid" alt=""></a></li>
    <li><a href="javascript:;" onclick="share_social('twitter', window.location.href, '<?= $this->event['description'] ?>');"><img src="<?= $_STATIC_URL ?>assets/images//icon/icn-tw.svg" class="img-fluid" alt=""></a></li>
    <li><a href="javascript:;" onclick="share_social('line', window.location.href, '<?= $this->event['description'] ?>');"><img src="<?= $_STATIC_URL ?>assets/images//icon/icn-line.svg" class="img-fluid" alt=""></a></li>
  </ul>
</div>

<section class="section-page bg-132F65">
  <div class="container">
    <div class="logo-bkp animated fadeInUp slower"><img src="<?= $_STATIC_URL ?>assets/images/logo/bp-logo.svg" class="img-fluid"></div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-6">
        <div class="title-top-detail">
        <div class="img-title animated fadeInUp slower"><img src="<?= $this->event['url_image_banner1'] ?>" class="img-fluid"></div>
          <div class="title-en animated fadeInUp slower">Wednesday, November 25, 2020<br>
            World Ballroom, 23rd Floor,<br>
            Centara Grand at CentralWorld<br>
            13:00 PM. - 17:30 PM.
          </div>
          <div class="title-th animated fadeInUp slower">วันพุธที่ 25 พฤศจิกายน พ.ศ. 2563<br>
            ณ ห้องเวิลด์บอลรูม ชั้น 23<br>
            โรงแรมเซ็นทารา แกรนด์ แอท เซ็นทรัลเวิลด์<br>
            เวลา 13:00 น. - 17:30 น.
          </div>
          <ul class="logo_sponsor animated fadeInUp slower" >
            <li><a href="javascript:;" target="_blank"><img src="<?= $_STATIC_URL ?>assets/images/logo_sponsor/HUAWEI.jpg" class="img-fluid"></a></li>
            <li><a href="javascript:;" target="_blank"><img src="<?= $_STATIC_URL ?>assets/images/logo_sponsor/ptted35.jpg" class="img-fluid"></a></li>
            <li><a href="javascript:;" target="_blank"><img src="<?= $_STATIC_URL ?>assets/images/logo_sponsor/tencent.jpg" class="img-fluid"></a></li>
            <li><a href="javascript:;" target="_blank"><img src="<?= $_STATIC_URL ?>assets/images/logo_sponsor/ngerntidlor.jpg" class="img-fluid"></a></li>
            <li><a href="javascript:;" target="_blank"><img src="<?= $_STATIC_URL ?>assets/images/logo_sponsor/kbank.jpg" class="img-fluid"></a></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-6">
        <div class="div-embed-video animated fadeInUp slower">
          <!-- <div class="embed-responsive embed-responsive-16by9">
             <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
          </div> -->
          <div><img src="<?= $this->event['url_image_banner2'] ?>" class="img-fluid" alt=""></div>
        </div>
        <div class="div-countdown animated fadeInUp slower">
          <ul>
            <li><span id="days"></span>DAY(S)</li>
            <li><span id="hours"></span>HOUR</li>
            <li><span id="minutes"></span>MINUTE</li>
            <li><span id="seconds"></span>SECOND</li>
          </ul>
        </div>
        <div class="div-btn animated fadeInUp slower">
          <!-- <button class="btn-forum<?= isset($is_closed) && $is_closed ? '-disabled' : '' ?>" data-hover="Register" <?= isset($is_closed) && !$is_closed ? 'onclick="GoToContent(\'register-form\');"' : 'disabled style="cursor: no-drop;"' ?>>Register</button> -->
          <button class="btn-forum" data-hover="Agenda" onclick="GoToContent('agenda-content');">Agenda</button>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- section speakers -->
<section class="section-page">
  <div class="container">
    <div class="text-title"><h2 data-aos="fade-up">Speakers</h2></div>
    <div class="content-speakersHead">
      <div class="row">
        <div class="col-6 col-md-6">
          <div class="div-speakers-list" data-aos="fade-up">
            <div class="div-speakers-img"><img src="assets/images/speakers/arkom.png" class="img-fluid" alt=""></div>
            <div class="divbox-border--speakers">
              <div class="div-speakers-name">H.E. Arkom Termpittayapaisith</div>
              <div class="div-speakers-detail">Minister of Finance</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-6">
          <div class="div-speakers-list" data-aos="fade-up">
            <div class="div-speakers-img"><img src="assets/images/speakers/ladda.png" class="img-fluid" alt=""></div>
            <div class="divbox-border--speakers">
              <div class="div-speakers-name">Sen. Ladda Tammy Duckworth</div>
              <div class="div-speakers-detail">U.S. Senator<br>Video address</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/aloke_lohia.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Aloke Lohia</div>
            <div class="div-speakers-detail">Group Chief Executive Officer,<br>Indorama Ventures</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/boon_vanasin.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Dr Boon Vanasin</div>
            <div class="div-speakers-detail">Chairman, Thonburi Healthcare Group (THG)</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/harald.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Harald Link</div>
            <div class="div-speakers-detail">Chairman, B. Grimn</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/suphajee.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Suphajee Suthumpun</div>
            <div class="div-speakers-detail">Group Chief Executive Officer,<br>Dusit Thani Pcl.</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/michael.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Michael MacDonald</div>
            <div class="div-speakers-detail">Chief Digital Officer,<br>Huawei Southeast Asia</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/chang_foo.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Chang Foo</div>
            <div class="div-speakers-detail">Chife Operating Officer,<br>Tencent Thailand</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/jack_zhang.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Jack Zhang</div>
            <div class="div-speakers-detail">Chief Executive Officer,<br>LAZADA Thailand</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/joshua.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Dr Joshua Pas</div>
            <div class="div-speakers-detail">Managing Director and Investment Committee,<br>AddVentures Capital by SCG</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/pinya.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Pinya Nittayakasetwat</div>
            <div class="div-speakers-detail">Chief Executive Officer,<br>Gojek Thailand</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="div-speakers-list" data-aos="fade-up">
          <div class="div-speakers-img"><img src="assets/images/speakers/ruangroj.png" class="img-fluid" alt=""></div>
          <div class="divbox-border--speakers">
            <div class="div-speakers-name">Ruangroj Poonpol</div>
            <div class="div-speakers-detail">Chairman,<br>KASIKORN Business-Technology Group (KBTG)</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /section speakers -->

<?php if(isset($is_closed) && !$is_closed){ ?>
<section id="register-form" class="section-page bg-F0F0F0">
  <div class="container">
    <div class="text-title"><h3 data-aos="fade-up">REGISTER FOR FREE</h3></div>
    <div class="form--forum">
      <form action="<?= base_url() ?>register" method="POST" id="registerForm"> 

      <div>
        <input type="hidden" name="register_person" value="1" />
      </div>
        	

        <div>
          <input name="name" id="name" class="form-control" type="text" placeholder="First Name" data-aos="fade-up">
          <span class="form-message"></span>
        </div>
        <div>
          <input name="lastname" id="lastname" class="form-control" type="text" placeholder="Last name" data-aos="fade-up">
          <span class="form-message"></span>
        </div>
        <div>
          <input name="position" id="position" class="form-control" type="text" placeholder="Position" data-aos="fade-up">
          <span class="form-message"></span>
        </div>
        <div>
          <input name="company" id="company" class="form-control" type="text" placeholder="Company" data-aos="fade-up">
          <span class="form-message"></span>
        </div>
        <div>
          <input name="email" id="email" class="form-control" type="text" placeholder="E-mail Address" data-aos="fade-up">
          <span class="form-message"></span>
        </div>
        <div>
          <input name="phone" id="phone" class="form-control" type="text" placeholder="Tel. Number" data-aos="fade-up">
          <span class="form-message"></span>
        </div>
        <div>
            <p data-aos="fade-up">
              <b>
              Translation device needed? (The forum will be conducted in English.)
              <span>ท่านต้องการอุปกรณ์แปลภาษาหรือไม่? (งานนี้ดำเนินการสัมมนาเป็นภาษาอังกฤษ)</span>
              </b>
            </p>
            <div class="tab-select" style="margin-bottom:20px;" >
              <p data-aos="fade-up"><label><input type="radio" name="translation" value="1"> Yes/ต้องการ</label></p>
              <p data-aos="fade-up"><label><input type="radio" name="translation" value="0" checked> No/ไม่ต้องการ</label></p>
            </div>

            <!-- <p data-aos="fade-up">
              <b>
              <span>ท่านต้องการรับชม live สด ผ่านเว็บไซต์ของเราหรือไม่?</span>
              </b>
            </p>
            <div class="tab-select" style="margin-bottom:20px;" >
              <p data-aos="fade-up"><label><input type="radio" name="live_video" value="1" checked> Yes/ต้องการ</label></p>
              <p data-aos="fade-up"><label><input type="radio" name="live_video" value="0"> No/ไม่ต้องการ</label></p>
            </div> -->

            <div data-aos="fade-up">
              <p style="font-weight:normal">Other<span>อื่นๆ</span></p>
              <div class="tab-select">
                <p><label><input type="checkbox" name="subscribe_1" value="1" checked > <span style="margin-left: 2px;">I would like to receive exclusive offers and updates from the Bangkok Post Group. ฉันต้องการรับขอเสนอพิเศษและข้อมูลอัพเดตจากกลุ่มบริษัทบางกอกโพสต์</span></label></p>
                <p><label style="margin-bottom: 40px;"><input type="checkbox" name="subscribe_2" value="1" checked > <span style="margin-left: 2px;"> I would like to receive special promotions from select partners. ฉันต้องการรับโปรโมชั่นพิเศษจากบริษัทคู่ค้าของกลุ่มบริษัทบางกอกโพสต์</span></label></p>
              </div>
            </div>
        </div>
        <!-- <div>
          <select name="option" id="option" class="form-control custom-select" data-aos="fade-up">
            <option value="">Your Lastest High School/University"</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
          <span class="form-message"></span>
        </div> -->
        
        <div class="div-btn" data-aos="fade-up"><button id="submitBtn" type="submit" class="btn-forum" data-hover="Register Now!">Register Now!</button></div>
      </form>
    </div>
  </div>
</section>
<?php } ?>

<section id="agenda-content" class="section-page bg-132F65">
<div class="container">
    <div class="text-title txt-fff"><h2 data-aos="fade-up">Agenda</h2></div>

    <div class="timeline-content">
      <ul class="timeline">
        <li class="event" data-date="12.30 – 13.20" data-aos="fade-up">
          <h3>Registration</h3>
        </li>
        <li class="event" data-date="13.20 – 13.30" data-aos="fade-up">
          <h3>Welcome Speech by</h3>
          <div class="box-name">Worachai Bhicharnchitr,</div>
          <div class="box-position">Vice Chairman, Bangkok Post Public Company Limited</div>
        </li>
        <li class="event" id="date" data-date="13.30 – 14.30" data-aos="fade-up">
          <h3>Keynote speaker:</h3>
          <div class="box-name">H.E. Arkom Termpittayapaisith,</div>
          <div class="box-position">Minister of Finance</div>
        </li>
        <li class="event" data-date="14.30 – 14.45" data-aos="fade-up">
          <h3>Keynote speaker:</h3>
          <div class="box-name">Sen. Ladda Tammy Duckworth,</div>
          <div class="box-position">U.S. Senator (Video address)</div>
        </li>
        <li class="event" data-date="14.45 – 16.00" data-aos="fade-up">
          
          <h3>Panel discussion:</h3>
          <div class="box-name">Beyond the Crisis: How companies will adapt for the new era </div>
          <div class="box-name">Panelists:</div>
          <div class="box-name">Aloke Lohia,</div>
          <div class="box-position">Group Chief Executive Officer, Indorama Ventures</div>
          <div class="box-name">Dr Boon Vanasin,</div>
          <div class="box-position">Chairman, Thonburi Healthcare Group (THG)</div>
          <div class="box-name">Harald Link,</div>
          <div class="box-position">Chairman, B. Grimm</div>
          <div class="box-name">Michael MacDonald, </div>
          <div class="box-position">Chief Digital Officer, Huawei Southeast Asia</div>
          <div class="box-name">Suphajee Suthumpun,</div>
          <div class="box-position">Group Chief Executive Officer, Dusit Thani Pcl.</div>
          <div class="box-name">Moderator: </div>
          <div class="box-position"><b>Varin Sachdev, </b>News Anchor</div>
        </li>
        <li class="event" data-date="16.00 – 16.15" data-aos="fade-up">
          <h3>Coffee Break</h3>
        </li>
        <li class="event" data-date="16.15 – 17.30" data-aos="fade-up">
          <h3>Panel discussion:</h3>
          <div class="box-name">A New Path Forward: Build a digital future</div>
          <div class="box-name">Panelists:</div>
          <div class="box-name">Chang Foo,</div>
          <div class="box-position">Chief Operating Officer, Tencent Thailand</div>
          <div class="box-name">Jack Zhang, </div>
          <div class="box-position">Chief Executive Officer, LAZADA Thailand</div>
          <div class="box-name">Dr Joshua Pas,</div>
          <div class="box-position">Managing Director and Investment Committee, AddVentures Capital by SCG</div>
          <div class="box-name">Pinya Nittayakasetwat, </div>
          <div class="box-position">Chief Executive Officer, Gojek Thailand</div>
          <div class="box-name">Ruangroj Poonpol,</div>
          <div class="box-position">Chairman, KASIKORN Business-Technology Group (KBTG)</div>
          <div class="box-name">Moderator: </div>
          <div class="box-position"><b>Varin Sachdev, </b>News Anchor</div>
        </li>
      </ul>
    </div>

  </div>
</section>

<section class="section-page">
  <div class="container">
    <div class="text-title"><h3 data-aos="fade-up">This event is fully booked. Thank you for your interest.</h3></div>
    <div class="row">
      <div class="col-12">
        <div class="div-countdown countdown--bottom animated fadeInUp slower">
          <ul>
            <li><span id="days2"></span>DAY(S)</li>
            <li><span id="hours2"></span>HOUR</li>
            <li><span id="minutes2"></span>MINUTE</li>
            <li><span id="seconds2"></span>SECOND</li>
          </ul>
        </div>
        <!-- <div class="div-btn" data-aos="fade-up"><button class="btn-forum<?= isset($is_closed) && $is_closed ? '-disabled' : '' ?>" data-hover="Register Now!" <?= isset($is_closed) && !$is_closed ? 'onclick="GoToContent(\'register-form\');"' : 'disabled style="cursor: no-drop;"' ?>>Register Now!</button></div> -->
      </div>
    </div>
  </div>
</section>


<section class="section-footer bg-F0F0F0">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-9" data-aos="fade-up">
        <div class="div-footer">
          <h4>For inquiries, please contact:</h4>
          <p><a href="mailto:<?= $this->event['contact_email'] ?>" target="_blank"><?= $this->event['contact_email'] ?></a></p>
        </div>
      </div>
      <!-- <div class="col-12 col-md-3">
        <div class="div-footer--header" data-aos="fade-up">SCAN QR CODE HERE</div>
        <div class="div-footer--qrcode" data-aos="fade-up"><img src="assets/images/img-qrcode.jpg" class="img-fluid" alt=""></div>
      </div> -->
    </div>
  </div>
</section>

