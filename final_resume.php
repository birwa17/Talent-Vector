<?php
session_start();
$resume = $_SESSION['resume'] ?? null;
$template = $_SESSION['selected_template'] ?? 'default';

if (!$resume) {
  echo "No resume data found.";
  exit;
}

$educationEntries = isset($resume['education']) ? json_decode($resume['education'], true) ?? [] : [];
$experienceEntries = isset($resume['experience']) ? json_decode($resume['experience'], true) ?? [] : [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Final Resume</title>
  <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">

  <?php if ($template == 'template1'): ?>
    <link rel="stylesheet" href="templates/template1.css">
  <?php elseif ($template == 'template2'): ?>
    <link rel="stylesheet" href="templates/template2.css">
  <?php elseif ($template == 'template3'): ?>
    <link rel="stylesheet" href="templates/template3.css">
  <?php elseif ($template == 'template4'): ?>
    <link rel="stylesheet" href="templates/template4.css">
  <?php elseif ($template == 'template5'): ?>
    <link rel="stylesheet" href="templates/template5.css">
  <?php elseif ($template == 'template6'): ?> 
    <link rel="stylesheet" href="templates/template6.css">
  <?php elseif ($template == 'template7'): ?>
    <link rel="stylesheet" href="templates/template7.css">
  <?php elseif ($template == 'template8'): ?>
    <link rel="stylesheet" href="templates/template8.css">
  <?php elseif ($template == 'template9'): ?>
    <link rel="stylesheet" href="templates/template9.css">
  <?php elseif ($template == 'template10'): ?>
    <link rel="stylesheet" href="templates/template10.css">
    <?php else: ?>
    <link rel="stylesheet" href="templates/default.css">
  <?php endif; ?>
</head>
<body>


  <?php if ($template == 'template2'): ?>
  <div class="resume template2" id="resume">
    <div class="left-column">
      <img src="<?= $resume['profilePic'] ?>" alt="Profile Picture" class="profile-pic" width="100" height="100">
      <div class="section">
        <h3>Contact</h3>
        <p><?= $resume['address'] ?? '' ?></p>
        <p><?= $resume['phone'] ?></p>
        <p><?= $resume['email'] ?></p>
        <p><?= $resume['website'] ?? '' ?></p>
      </div>
      <div class="section">
        <h3>Skills</h3>
        <p><?= $resume['skills'] ?></p>
      </div>
      <div class="section">
        <h3>Summary</h3>
        <p><?= $resume['summary'] ?></p>
      </div>
    </div>

    <div class="right-column">
      <h1><span><?= explode(" ", $resume['name'])[0] ?? '' ?></span> <?= explode(" ", $resume['surname'])[0] ?? '' ?></h1>
      <h2><?= $resume['jobTitle'] ?? 'Registered Nurse' ?></h2>

      <div class="section">
        <h3>Education</h3>
        <p><?= $resume['degree'] ?> | <?= $resume['schoolName'] ?></p>
        <p>(<?= $resume['eduStartDate'] ?> - <?= $resume['eduEndDate'] ?>)</p>
      </div>

      <div class="section">
        <h3>Experience</h3>
        <p><strong><?= $resume['jobTitle'] ?></strong> | <?= $resume['employer'] ?></p>
        <p><?= $resume['jobStartDate'] ?> - <?= $resume['jobEndDate'] ?></p>
        <p><?= $resume['jobDescription'] ?></p>
      </div>
    </div>
  </div>

  <?php elseif ($template == 'template3'): ?>
  <div class="resume-container" id="resume">
    <div class="left-column">
      <h1><?= $resume['name'] . " " . $resume['surname'] ?></h1>
      <img src="<?= $resume['profilePic'] ?>" alt="Profile Picture" class="profile-pic" width="100" height="100">
      <section>
        <h2>Contact Info</h2>
        <p><?= $resume['email'] ?><br><?= $resume['phone'] ?><br><?= $resume['city'] . ', ' . $resume['state'] ?></p>
      </section>
    </div>

    <div class="right-column">
      <h2>Work Experience</h2>
      <div class="item">
        <h3><?= $resume['jobTitle'] ?? '' ?> - <?= $resume['employer'] ?? '' ?></h3>
        <span><?= $resume['jobStartDate'] ?? '' ?> to <?= $resume['jobEndDate'] ?? '' ?></span>
        <p><?= $resume['jobDescription'] ?? '' ?></p>
      </div>

      <h2>Education</h2>
      <div class="item">
        <h3><?= $resume['degree'] ?? '' ?> - <?= $resume['schoolName'] ?? '' ?></h3>
        <span><?= $resume['eduStartDate'] ?? '' ?> to <?= $resume['eduEndDate'] ?? '' ?></span>
        <p><?= $resume['educationDetails'] ?? '' ?></p>
      </div>

      <h2>Skills</h2>
      <p><?= $resume['skills'] ?? '' ?></p>
    </div>
  </div>


<?php elseif ($template == 'template4'): ?>
  <div class="resume-container" id="resume">
    <div class="left-column">
      <img src="<?= $resume['profilePic'] ?>" alt="Profile Picture" class="profile-pic" width="100" height="100">
      <h1><span><?= $resume['name'] ?></span> <?= $resume['surname'] ?></h1>
      <h2><?= $resume['jobTitle'] ?? 'Professional Title' ?></h2>
      <div class="contact">
        <p><?= $resume['phone'] ?><br><?= $resume['email'] ?><br><?= $resume['address'] ?><br><?= $resume['city'] . ', ' . $resume['state'] . ', ' . $resume['country'] . ' - ' . $resume['pincode'] ?></p>
      </div>
    </div>

    <div class="right-column">
      <section>
        <h3>Profile</h3>
        <p><?= $resume['summary'] ?? '' ?></p>
      </section>

      <section>
        <h3>Experience</h3>
        <h4><?= $resume['jobTitle'] ?> - <?= $resume['employer'] ?></h4>
        <span><?= $resume['jobStartDate'] ?> to <?= $resume['jobEndDate'] ?> | <?= $resume['jobLocation'] ?></span>
        <p><?= $resume['jobDescription'] ?></p>
      </section>

      <section>
        <h3>Education</h3>
        <h4><?= $resume['degree'] ?> - <?= $resume['schoolName'] ?></h4>
        <span><?= $resume['eduStartDate'] ?> to <?= $resume['eduEndDate'] ?> | <?= $resume['schoolLocation'] ?></span>
        <p><?= $resume['educationLevel'] ?></p>
      </section>

      <section>
        <h3>Skills</h3>
        <p><?= $resume['skills'] ?></p>
      </section>
    </div>
  </div>

  <?php elseif ($template == 'template5'): ?>
  <div class="resume-container" id="resume">
    <div class="left-column">
      <div class="profile-pic">
        <img src="<?= $resume['profilePic'] ?? 'path-to-profile.jpg' ?>" alt="Profile" width="100" height="100"/>
      </div>
      <h2><?= $resume['name'] ?? '' ?></h2>
      <p><?= $resume['title'] ?? '' ?></p>

      <div class="section">
        <h3>Contact</h3>
        <p><?= $resume['email'] ?? '' ?></p>
        <p><?= $resume['phone'] ?? '' ?></p>
        <p><?= $resume['address'] ?? '' ?></p>
      </div>

      <div class="section">
        <h3>Skills</h3>
        <ul>
          <?php foreach (explode(',', $resume['skills'] ?? '') as $skill): ?>
            <li><?= trim($skill) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="section">
        <h3>Languages</h3>
        <p><?= $resume['languages'] ?? '' ?></p>
      </div>

      <div class="section">
        <h3>Hobbies</h3>
        <p><?= $resume['hobbies'] ?? '' ?></p>
      </div>
    </div>

    <div class="right-column">
      <h1><?= $resume['name'] ?? '' ?></h1>
      <p class="subheading"><?= $resume['title'] ?? '' ?></p>

      <h2>Education</h2>
      <?php foreach ($educationEntries as $edu): ?>
        <div class="edu-entry">
          <h3><?= $edu['degree'] ?? '' ?></h3>
          <p><?= $edu['schoolName'] ?? '' ?> | <?= $edu['startDate'] ?? '' ?> - <?= $edu['endDate'] ?? '' ?></p>
          <p><?= $edu['description'] ?? '' ?></p>
        </div>
      <?php endforeach; ?>

      <h2>Experience</h2>
      <?php foreach ($experienceEntries as $exp): ?>
        <div class="exp-entry">
          <h3><?= $exp['jobTitle'] ?? '' ?> – <?= $exp['companyName'] ?? '' ?></h3>
          <p><?= $exp['startDate'] ?? '' ?> - <?= $exp['endDate'] ?? '' ?></p>
          <p><?= $exp['jobDescription'] ?? '' ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php elseif ($template == 'template6'): ?>
<div class="template6-container">
  <div class="left-panel">
    <div class="profile-pic">
      <?php if (!empty($resume['profilePic'])): ?>
        <img src="<?= htmlspecialchars($resume['profilePic']) ?>" alt="Profile Picture" width="100" height="100"/>
      <?php endif; ?>
    </div>
    <h1><?= htmlspecialchars($resume['name']) ?> <?= htmlspecialchars($resume['surname']) ?></h1>
    <div class="section">
  <h2>Work Experience</h2>
  <?php foreach ($experienceEntries as $exp): ?>
    <div class="entry">
      <strong><?= htmlspecialchars($exp['jobTitle'] ?? '') ?> | <?= htmlspecialchars($exp['jobStartDate'] ?? '') ?> - <?= htmlspecialchars($exp['jobEndDate'] ?? '') ?></strong><br>
      <em><?= htmlspecialchars($exp['employer'] ?? '') ?></em><br>
      <p><i><?= htmlspecialchars($exp['jobLocation'] ?? '') ?></i></p>
      <p><?= nl2br(htmlspecialchars($exp['jobDescription'] ?? '')) ?></p>
    </div>
  <?php endforeach; ?>
</div>
    <div class="section">
      <h2>Soft Skills</h2>
      <ul class="skills">
        <?php foreach (explode(',', $resume['skills']) as $skill): ?>
          <li><?= htmlspecialchars(trim($skill)) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="right-panel">
  <div class="contact-info">
    <p><strong>📞</strong> <?= htmlspecialchars($resume['phone'] ?? '') ?></p>
    <p><strong>📧</strong> <?= htmlspecialchars($resume['email'] ?? '') ?></p>
    <p><strong>📍</strong> 
      <?= htmlspecialchars($resume['address'] ?? '') ?>,
      <?= htmlspecialchars($resume['city'] ?? '') ?> -
      <?= htmlspecialchars($resume['pincode'] ?? '') ?>,
      <?= htmlspecialchars($resume['state'] ?? '') ?>,
      <?= htmlspecialchars($resume['country'] ?? '') ?>
    </p>
  </div>

  <div class="section"> 
  <h2>Education</h2>
  <?php foreach ($educationEntries as $edu): ?>
    <div class="entry">
      <strong><?= htmlspecialchars($edu['schoolName']) ?> 
        (<?= htmlspecialchars($edu['eduStartDate']) ?> - <?= htmlspecialchars($edu['eduEndDate']) ?>)
      </strong>
      <p><?= htmlspecialchars($edu['degree']) ?> — <?= htmlspecialchars($edu['educationLevel']) ?></p>
      <p><em><?= htmlspecialchars($edu['schoolLocation']) ?></em></p>
    </div>
  <?php endforeach; ?>
</div>

  </div>
</div>

<?php elseif ($template == 'template7'): ?>
<div class="resume-container" id="resume">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="profile-pic">
      <img src="<?= $resume['profilePic'] ?>" alt="Profile Picture" class="profile-img" width="100" height="100">
    </div>

    <h2><?= $resume['name'] ?> <?= $resume['surname'] ?></h2>
    <p><?= $resume['jobTitle'] ?? 'Student' ?></p>

    <div class="section">
      <h3>Contact</h3>
      <p><?= $resume['email'] ?><br><?= $resume['phone'] ?><br><?= $resume['city'] ?>, <?= $resume['state'] ?></p>
    </div>

    <h3>Skills</h3>
    <div class="skill">
      <span>Teamwork</span>
      <div class="bar"><div class="fill" style="width: 85%;"></div></div>
    </div>

    <div class="skill">
      <span>Communication</span>
      <div class="bar"><div class="fill" style="width: 90%;"></div></div>
    </div>

    <div class="skill">
      <span>MS Office</span>
      <div class="bar"><div class="fill" style="width: 75%;"></div></div>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="main-content">
    <section>
      <h2>Summary</h2>
      <p><?= $resume['summary'] ?></p>
    </section>

    <section>
  <h2>Education</h2>
  <?php if (!empty($resume['education']) && is_array($resume['education'])): ?>
    <?php foreach ($resume['education'] as $edu): ?>
      <p><?= $edu['degree'] ?> | <?= $edu['institution'] ?> | <?= $edu['year'] ?></p>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No education details provided.</p>
  <?php endif; ?>
</section>

<section>
  <h2>Experience</h2>
  <?php if (!empty($resume['experience']) && is_array($resume['experience'])): ?>
    <?php foreach ($resume['experience'] as $exp): ?>
      <p><?= $exp['role'] ?> | <?= $exp['company'] ?> | <?= $exp['duration'] ?></p>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No experience details provided.</p>
  <?php endif; ?>
</section>


</div>

<?php elseif ($template == 'template8'): ?>
  <div class="resume-medical" id="resume">
    <div class="resume-header">
      <img src="<?= $resume['profilePic'] ?>" alt="Profile Picture"   class="profile-img" width="100" height="100"/>
      <h1><?= $resume['name'] ?> <?= $resume['surname'] ?></h1>
      <p><?= $resume['email'] ?> | <?= $resume['phone'] ?> | <?= $resume['city'] ?> <?= $resume['state'] ?></p>
    </div>

    <div class="resume-section">
      <h2>Professional Summary</h2>
      <p><?= $resume['summary'] ?? 'N/A' ?></p>
    </div>

    <div class="resume-section">
      <h2>Licenses & Certifications</h2>
      <p><?= $resume['certifications'] ?? 'Available upon request' ?></p>
    </div>

    <div class="resume-section">
      <h2>Experience</h2>
      <?php if (!empty($resume['experience']) && is_array($resume['experience'])): ?>
        <ul>
          <?php foreach ($resume['experience'] as $exp): ?>
            <li><strong><?= $exp['job_title'] ?? '' ?></strong> at <?= $exp['company'] ?? '' ?> (<?= $exp['start_date'] ?? '' ?> - <?= $exp['end_date'] ?? 'Present' ?>)</li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>No experience provided.</p>
      <?php endif; ?>
    </div>

    <div class="resume-section">
      <h2>Education</h2>
      <?php if (!empty($resume['education']) && is_array($resume['education'])): ?>
        <ul>
          <?php foreach ($resume['education'] as $edu): ?>
            <li><strong><?= $edu['degree'] ?? '' ?></strong> from <?= $edu['institution'] ?? '' ?> (<?= $edu['year'] ?? '' ?>)</li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>No education history provided.</p>
      <?php endif; ?>
    </div>
  </div>

  <?php elseif ($template == 'template9'): ?>
  

  <div class="resume-teacher" id="resume">
    <div class="top-header">
      <div>
        <h1><?= $resume['name'] ?> <?= $resume['surname'] ?></h1>
        <p><?= $resume['jobTitle'] ?? 'Teacher' ?></p>
      </div>
      <img src="<?= $resume['profilePic'] ?>" alt="Profile Picture" class="profile-img" width="100" height="100"/>
    </div>

    <div class="info-bar">
      <?= $resume['email'] ?> | <?= $resume['phone'] ?> | <?= $resume['city'] ?>, <?= $resume['state'] ?>
    </div>

    <section class="section">
      <h2>Summary</h2>
      <p><?= $resume['summary'] ?></p>
    </section>

    <section class="section">
      <h2>Experience</h2>
      <?php foreach ($experienceEntries as $exp): ?>
        <div class="entry">
          <strong><?= $exp['jobTitle'] ?> – <?= $exp['companyName'] ?></strong>
          <small><?= $exp['startDate'] ?> - <?= $exp['endDate'] ?></small>
          <p><?= $exp['jobDescription'] ?></p>
        </div>
      <?php endforeach; ?>
    </section>

    <section class="section">
      <h2>Education</h2>
      <?php foreach ($educationEntries as $edu): ?>
        <div class="entry">
          <strong><?= $edu['degree'] ?> – <?= $edu['schoolName'] ?></strong>
          <small><?= $edu['eduStartDate'] ?> - <?= $edu['eduEndDate'] ?></small>
        </div>
      <?php endforeach; ?>
    </section>

    <section class="section">
      <h2>Skills</h2>
      <ul class="skills">
        <?php foreach (explode(',', $resume['skills']) as $skill): ?>
          <li><?= htmlspecialchars(trim($skill)) ?></li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div>

  <?php elseif ($template == 'template10'): ?>
<div class="resume-template10" id="resume">
  <aside class="sidebar">
    <div class="photo-circle">
      <img src="<?= $resume['profilePic'] ?>" alt="Profile Picture" class="profile-img" width="100" height="100"/>
    </div>
    <h1><?= $resume['name'] ?> <?= $resume['surname'] ?></h1>
    <h2><?= $resume['jobTitle'] ?? 'Professional Title' ?></h2>

    <div class="contact-info">
      <p><strong>Email:</strong> <?= $resume['email'] ?></p>
      <p><strong>Phone:</strong> <?= $resume['phone'] ?></p>
      <p><strong>Address:</strong> <?= $resume['address'] ?>, <?= $resume['city'] ?>, <?= $resume['state'] ?>, <?= $resume['country'] ?> - <?= $resume['pincode'] ?></p>
    </div>

    <div class="skills">
      <h3>Skills</h3>
      <ul>
        <?php foreach (explode(',', $resume['skills']) as $skill): ?>
          <li><?= htmlspecialchars(trim($skill)) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </aside>

  <main class="content">
    <section class="summary">
      <h3>Professional Summary</h3>
      <p><?= $resume['summary'] ?></p>
    </section>

    <section class="experience">
      <h3>Work Experience</h3>
      <?php foreach ($experienceEntries as $exp): ?>
        <div class="item">
          <h4><?= $exp['jobTitle'] ?> at <?= $exp['companyName'] ?></h4>
          <p><em><?= $exp['startDate'] ?> - <?= $exp['endDate'] ?></em></p>
          <p><?= $exp['jobDescription'] ?></p>
        </div>
      <?php endforeach; ?>
    </section>

    <section class="education">
      <h3>Education</h3>
      <?php foreach ($educationEntries as $edu): ?>
        <div class="item">
          <h4><?= $edu['degree'] ?>, <?= $edu['schoolName'] ?></h4>
          <p><em><?= $edu['eduStartDate'] ?> - <?= $edu['eduEndDate'] ?></em></p>
          <p><?= $edu['educationLevel'] ?? '' ?> | <?= $edu['schoolLocation'] ?? '' ?></p>
        </div>
      <?php endforeach; ?>
    </section>
  </main>
</div>

<?php else: ?>
  <div class="resume <?= $template ?>" id="resume">
    <img src="<?= $resume['profilePic'] ?>" width="100" height="100">
    <h1><?= $resume['name'] . " " . $resume['surname'] ?></h1>
    <p>Email: <?= $resume['email'] ?> | Phone: <?= $resume['phone'] ?></p>
    <p>Location: <?= $resume['city'] . ", " . $resume['state'] ?></p>

    <h2>Summary</h2>
    <p><?= $resume['summary'] ?></p>

    <h2>Skills</h2>
    <p><?= $resume['skills'] ?></p>

    <h2>Experience</h2>
    <p><strong><?= $resume['jobTitle'] ?></strong> <?= $resume['employer'] ?> (<?= $resume['jobStartDate'] ?> - <?= $resume['jobEndDate'] ?>)</p>
    <p><?= $resume['jobDescription'] ?></p>

    <h2>Education</h2>
    <p><?= $resume['degree'] ?> <?= $resume['schoolName'] ?> (<?= $resume['eduStartDate'] ?> - <?= $resume['eduEndDate'] ?>)</p>
  </div>

  
<?php endif; ?>

<button onclick="downloadPDF()">Download as PDF</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
  function downloadPDF() {
    const element = document.getElementById('resume');
    html2pdf().from(element).save('resume.pdf');
  }
</script>

</body>
</html>
