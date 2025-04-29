<div class="chart-container">
  <h1><?= htmlspecialchars($competition['title'] ?? 'Competition') ?> - Statistics</h1>
  <div class="chart-wrapper">
    <div class="chart-header">
      <h2 class="chart-title">Total Participants</h2>
      <button class="download-btn">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
          <polyline points="7 10 12 15 17 10" />
          <line x1="12" y1="15" x2="12" y2="3" />
        </svg>
        Download PDF
      </button>
    </div>
    <div class="chart">
      <svg viewBox="0 0 1000 200" preserveAspectRatio="none">
        <?php

        if (!empty($stats['participants'])) {
          $points = [];
          $maxValue = max($stats['participants']);
          $minValue = min($stats['participants']);
          $range = $maxValue - $minValue;
          $range = $range > 0 ? $range : 1;

          foreach ($stats['participants'] as $index => $value) {
            $x = ($index / (count($stats['participants']) - 1)) * 1000;
            $y = 200 - (($value - $minValue) / $range) * 150 - 25;
            $points[] = "$x,$y";
          }

          echo '<path class="line" d="M' . implode(' L', $points) . '" />';
        } else {
          echo '<path class="line" d="M0,100 Q250,50 500,150 T1000,100" />';
        }
        ?>
      </svg>
    </div>
    <div class="chart-labels">
      <?php foreach ($stats['months'] ?? ['Jan 2023', 'Feb 2023', 'Mar 2023', 'Apr 2023', 'May 2023', 'Jun 2023', 'Jul 2023'] as $month): ?>
        <span><?= htmlspecialchars($month) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="chart-container">
  <div class="chart-header">
    <h2 class="chart-title">Total Submissions</h2>
    <button class="download-btn">
      <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
        <polyline points="7 10 12 15 17 10" />
        <line x1="12" y1="15" x2="12" y2="3" />
      </svg>
      Download PDF
    </button>
  </div>
  <div class="chart">
    <svg viewBox="0 0 1000 200" preserveAspectRatio="none">
      <?php

      if (!empty($stats['submissions'])) {
        $points = [];
        $maxValue = max($stats['submissions']);
        $minValue = min($stats['submissions']);
        $range = $maxValue - $minValue;
        $range = $range > 0 ? $range : 1;

        foreach ($stats['submissions'] as $index => $value) {
          $x = ($index / (count($stats['submissions']) - 1)) * 1000;
          $y = 200 - (($value - $minValue) / $range) * 150 - 25;
          $points[] = "$x,$y";
        }

        echo '<path class="line" d="M' . implode(' L', $points) . '" />';
      } else {
        echo '<path class="line" d="M0,100 Q250,50 500,150 T1000,100" />';
      }
      ?>
    </svg>
  </div>
  <div class="chart-labels">
    <?php foreach ($stats['months'] ?? ['Jan 2023', 'Feb 2023', 'Mar 2023', 'Apr 2023', 'May 2023', 'Jun 2023', 'Jul 2023'] as $month): ?>
      <span><?= htmlspecialchars($month) ?></span>
    <?php endforeach; ?>
  </div>
</div>

<div class="download-all-container">
  <button class="download-all-btn">
    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
      stroke-linejoin="round">
      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
      <polyline points="7 10 12 15 17 10" />
      <line x1="12" y1="15" x2="12" y2="3" />
    </svg>
    Download All Statistics
  </button>
</div>
</main>

<?php
require_once "../app/views/layout/footer.php";
?>

</body>

</html>