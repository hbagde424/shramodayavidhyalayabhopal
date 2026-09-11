<?php
$page_title = "हमारे बारे में";
require_once __DIR__ . '/includes/header.php';
?>
<div class="container py-5">
  <div class="section-title"><h3>हमारे बारे में</h3></div>

  <div class="row g-4">
    <div class="col-md-6">
      <h5 class="text-success">विद्यालय परिचय</h5>
      <p>यह विद्यालय मध्यप्रदेश शासन श्रम विभाग के अंतर्गत भवन एवं अन्य सन्निर्माण कर्मकार कल्याण मण्डल द्वारा संचालित है। इसकी स्थापना पंजीकृत निर्माण श्रमिकों के बालक-बालिकाओं को उत्तम गुणवत्ता की निःशुल्क आवासीय शिक्षा उपलब्ध कराने हेतु की गई है।</p>
      <p>विद्यालय में कक्षा 6वीं से 12वीं तक अध्ययन की सुविधा उपलब्ध है, साथ ही खेल, कला, संगीत एवं व्यक्तित्व विकास हेतु विशेष कार्यक्रम आयोजित किये जाते हैं।</p>
    </div>
    <div class="col-md-6">
      <h5 class="text-success">परिकल्पना एवं उद्देश्य</h5>
      <ul>
        <li>पंजीकृत निर्माण श्रमिकों के बालक-बालिकाओं को गुणवत्तापूर्ण शिक्षा प्रदान करना।</li>
        <li>छात्र-छात्राओं का शारीरिक, बौद्धिक, सांस्कृतिक एवं नैतिक विकास करना।</li>
        <li>सभी वर्गों के लिए शिक्षा में समानता एवं सामाजिक न्याय सुनिश्चित करना।</li>
        <li>सुरक्षित एवं सकारात्मक वातावरण में विद्यार्थियों को भविष्य हेतु तैयार करना।</li>
      </ul>
    </div>
  </div>

  <hr class="my-5">

  <div class="section-title"><h3>अधोसंरचना</h3></div>
  <div class="row g-4 text-center">
    <?php
    $infra = [
      ['icon' => 'bi-building', 'label' => 'शैक्षणिक भवन'],
      ['icon' => 'bi-house-door', 'label' => 'बालक छात्रावास'],
      ['icon' => 'bi-house-heart', 'label' => 'बालिका छात्रावास'],
      ['icon' => 'bi-book', 'label' => 'पुस्तकालय'],
      ['icon' => 'bi-laptop', 'label' => 'कंप्यूटर लैब'],
      ['icon' => 'bi-flask', 'label' => 'विज्ञान प्रयोगशालाएं'],
      ['icon' => 'bi-easel2', 'label' => 'स्मार्ट क्लासरूम'],
      ['icon' => 'bi-music-note-beamed', 'label' => 'संगीत कक्ष'],
    ];
    foreach ($infra as $item):
    ?>
    <div class="col-6 col-md-3">
      <div class="info-card">
        <i class="bi <?php echo $item['icon']; ?>"></i>
        <h6 class="mt-2 mb-0"><?php echo $item['label']; ?></h6>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
