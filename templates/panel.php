<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bot Panel - Vision Community</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #00ff88;
      --secondary: #00cc6a;
      --dark: #0a0a0a;
      --light: #1a1a1a;
      --card-bg: #1e1e1e;
      --text-light: #ffffff;
      --text-gray: #888888;
    }
    
    body {
      background: linear-gradient(135deg, var(--dark) 0%, #1a1a2e 50%, #16213e 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      color: var(--text-light);
    }
    
    .navbar {
      background: rgba(30, 30, 30, 0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0, 255, 136, 0.2);
    }
    
    .card {
      background: var(--card-bg);
      border: 1px solid rgba(0, 255, 136, 0.1);
      border-radius: 15px;
      backdrop-filter: blur(10px);
    }
    
    .card-header {
      background: rgba(0, 255, 136, 0.1);
      border-bottom: 1px solid rgba(0, 255, 136, 0.2);
      color: var(--primary);
      font-weight: 600;
    }
    
    .btn-primary {
      background: var(--primary);
      border: none;
      color: #000;
      font-weight: 600;
      border-radius: 10px;
      transition: all 0.3s;
    }
    
    .btn-primary:hover {
      background: var(--secondary);
      transform: translateY(-2px);
    }
    
    .nav-tabs .nav-link {
      color: var(--text-gray);
      border: none;
    }
    
    .nav-tabs .nav-link.active {
      background: transparent;
      color: var(--primary);
      border-bottom: 2px solid var(--primary);
    }
    
    .project-card {
      transition: all 0.3s;
      cursor: pointer;
    }
    
    .project-card:hover {
      transform: translateY(-5px);
      border-color: var(--primary);
    }
    
    .alert-success {
      background: rgba(0, 255, 136, 0.1);
      border: 1px solid var(--primary);
      color: var(--primary);
    }
    
    .alert-error {
      background: rgba(255, 68, 68, 0.1);
      border: 1px solid #ff4444;
      color: #ff4444;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <span style="color: var(--primary)">🤖</span> Vision Bot Panel
      </a>
      <div class="navbar-nav ms-auto">
        <a class="nav-link" href="/" style="color: var(--primary)">Çıkış Yap</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <!-- Flash Messages -->
    {% with messages = get_flashed_messages(with_categories=true) %}
      {% if messages %}
        {% for category, message in messages %}
          <div class="alert alert-{{ 'success' if category == 'success' else 'error' }} alert-dismissible fade show">
            {{ message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        {% endfor %}
      {% endif %}
    {% endwith %}

    <ul class="nav nav-tabs mb-4" id="panelTabs">
      <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#import">📥 Proje İçe Aktar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#projects">📁 Projelerim</a>
      </li>
    </ul>

    <div class="tab-content">
      <!-- Import Tab -->
      <div class="tab-pane fade show active" id="import">
        <div class="row">
          <!-- GitHub Import -->
          <div class="col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <h5 class="mb-0">🚀 GitHub'dan İçe Aktar</h5>
              </div>
              <div class="card-body">
                <form action="/clone_repo" method="post">
                  <div class="mb-3">
                    <label class="form-label">GitHub Repository URL</label>
                    <input type="text" name="repo_url" class="form-control" placeholder="https://github.com/kullanici/repo.git" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Proje Adı (Opsiyonel)</label>
                    <input type="text" name="project_name" class="form-control" placeholder="Boş bırakırsanız repo adı kullanılır">
                  </div>
                  <button type="submit" class="btn btn-primary w-100">
                    📥 Repository Klonla
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- Zip Upload -->
          <div class="col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <h5 class="mb-0">📦 ZIP Dosyası Yükle</h5>
              </div>
              <div class="card-body">
                <form action="/upload_zip" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label class="form-label">ZIP Dosyası Seç</label>
                    <input type="file" name="zip_file" class="form-control" accept=".zip" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Proje Adı (Opsiyonel)</label>
                    <input type="text" name="project_name" class="form-control" placeholder="Boş bırakırsanız dosya adı kullanılır">
                  </div>
                  <button type="submit" class="btn btn-primary w-100">
                    ⬆️ ZIP Yükle ve Çıkar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Projects Tab -->
      <div class="tab-pane fade" id="projects">
        {% if projects %}
          <div class="row">
            {% for project in projects %}
            <div class="col-md-4 mb-3">
              <div class="card project-card" onclick="location.href='/project/{{ project.name }}'">
                <div class="card-body">
                  <h5 class="card-title">
                    {% if project.type == 'github' %}
                      📁
                    {% else %}
                      📦
                    {% endif %}
                    {{ project.name }}
                  </h5>
                  <p class="card-text text-muted">
                    <small>Oluşturulma: {{ project.created }}</small><br>
                    <small>Tip: {{ project.type|upper }}</small>
                  </p>
                  <div class="btn-group w-100">
                    <a href="/project/{{ project.name }}" class="btn btn-sm btn-outline-primary">Düzenle</a>
                    <button class="btn btn-sm btn-outline-success" onclick="runProject('{{ project.name }}', event)">Çalıştır</button>
                    <a href="/delete_project/{{ project.name }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                  </div>
                </div>
              </div>
            </div>
            {% endfor %}
          </div>
        {% else %}
          <div class="text-center py-5">
            <h4>Henüz projeniz bulunmuyor</h4>
            <p class="text-muted">İlk projenizi içe aktararak başlayın!</p>
          </div>
        {% endif %}
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function runProject(projectName, event) {
      event.stopPropagation();
      
      fetch(`/run_project/${projectName}`)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Proje başarıyla çalıştırıldı!\n\nÇıktı: ' + data.output);
          } else {
            alert('Proje çalıştırılırken hata oluştu!\n\nHata: ' + data.output);
          }
        })
        .catch(error => {
          alert('İstek hatası: ' + error);
        });
    }

    // Dosya yükleme bildirimi
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name;
      if (fileName) {
        const label = this.previousElementSibling;
        label.textContent = `Seçilen: ${fileName}`;
        label.style.color = 'var(--primary)';
      }
    });
  </script>
</body>
</html>
