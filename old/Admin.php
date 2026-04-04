<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Constructiva · Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#07100f;--bg2:#0b1a18;--bg3:#0f2320;
  --surface:#f3f8f7;--surface2:#e6f0ee;--border:rgba(13,110,100,.14);
  --teal:#0d9e8e;--teal2:#0b8779;--teal3:#0d6e64;
  --accent:#7c4fd4;--warn:#b86e00;--danger:#c43a3a;--success:#1a8a40;
  --text:#0f1f1d;--muted:rgba(15,31,29,.45);
  --sidebar-w:240px;
}
html{font-size:15px}
body{font-family:'DM Sans',sans-serif;background:#fff;color:var(--text);min-height:100vh;display:flex;overflow-x:hidden}

/* SIDEBAR */
.sidebar{width:var(--sidebar-w);min-height:100vh;background:#0b1a18;border-right:1px solid rgba(93,230,212,.10);display:flex;flex-direction:column;position:fixed;top:0;left:0;z-index:100;transition:transform .3s}
.sidebar-logo{padding:1.4rem 1.4rem 1rem;font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;color:#e8f5f3;text-decoration:none;border-bottom:1px solid rgba(93,230,212,.10);display:flex;align-items:center;gap:.5rem}
.sidebar-logo span{color:var(--teal)}
.sidebar-badge{background:rgba(240,122,122,.2);color:#f07a7a;font-size:.6rem;font-weight:800;padding:.15rem .5rem;border-radius:20px;font-family:'Syne',sans-serif}
.sidebar-nav{flex:1;padding:.6rem 0;overflow-y:auto}
.nav-label{font-size:.62rem;font-weight:700;letter-spacing:.12em;color:rgba(232,245,243,.35);text-transform:uppercase;padding:.8rem 1.2rem .3rem}
.nav-item{display:flex;align-items:center;gap:.7rem;padding:.58rem 1.2rem;color:rgba(232,245,243,.45);text-decoration:none;font-size:.82rem;border-left:2px solid transparent;transition:all .15s;cursor:pointer}
.nav-item:hover{color:#e8f5f3;background:rgba(93,230,212,.05)}
.nav-item.active{color:#5de6d4;border-left-color:#5de6d4;background:rgba(93,230,212,.07);font-weight:500}
.nav-icon{width:18px;height:18px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.nav-count{margin-left:auto;background:rgba(93,230,212,.15);color:#5de6d4;font-size:.6rem;font-weight:800;padding:.1rem .4rem;border-radius:10px}
.sidebar-footer{padding:.8rem 1.2rem;border-top:1px solid rgba(93,230,212,.10);font-size:.72rem;color:rgba(232,245,243,.35)}

/* MAIN */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{height:56px;background:#0b1a18;border-bottom:1px solid rgba(93,230,212,.10);display:flex;align-items:center;padding:0 1.8rem;gap:1rem;position:sticky;top:0;z-index:50}
.topbar-burger{display:none;background:none;border:none;color:#e8f5f3;cursor:pointer}
.topbar-breadcrumb{font-family:'Syne',sans-serif;font-size:.82rem;font-weight:600;color:rgba(232,245,243,.5)}
.topbar-breadcrumb span{color:#e8f5f3}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:.7rem}
.topbar-admin{font-family:'Syne',sans-serif;font-size:.72rem;font-weight:700;color:var(--teal);background:rgba(93,230,212,.1);padding:.3rem .8rem;border-radius:20px}

/* CONTENT */
.content{padding:1.8rem;flex:1}
.section{display:none}
.section.active{display:block}
.page-header{margin-bottom:1.8rem}
.page-label{font-size:.68rem;font-weight:700;letter-spacing:.12em;color:var(--teal);text-transform:uppercase;margin-bottom:.3rem}
.page-title{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;line-height:1.15}
.page-title em{font-style:italic;color:var(--teal)}
.page-sub{color:var(--muted);font-size:.82rem;margin-top:.3rem}

/* GRIDS */
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.4rem}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem;margin-bottom:1.4rem}
.grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.1rem;margin-bottom:1.4rem}

/* CARDS */
.card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.3rem;transition:border-color .2s}
.card:hover{border-color:rgba(93,230,212,.2)}
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
.card-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.88rem}

/* STAT CARDS */
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.3rem;display:flex;align-items:center;gap:.9rem}
.stat-icon{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0}
.stat-icon.teal{background:rgba(93,230,212,.12)}
.stat-icon.purple{background:rgba(176,122,240,.12)}
.stat-icon.warn{background:rgba(240,192,122,.12)}
.stat-icon.success{background:rgba(122,240,160,.12)}
.stat-icon.danger{background:rgba(240,122,122,.12)}
.stat-num{font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem;line-height:1}
.stat-label{font-size:.7rem;color:var(--muted);margin-top:.15rem}

/* TABLE */
.data-table{width:100%;border-collapse:collapse;font-size:.8rem}
.data-table th{text-align:left;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);padding:.65rem .9rem;border-bottom:1px solid var(--border)}
.data-table td{padding:.7rem .9rem;border-bottom:1px solid rgba(93,230,212,.05);vertical-align:middle}
.data-table tr:last-child td{border-bottom:none}
.data-table tr:hover td{background:rgba(93,230,212,.03)}

/* BADGES */
.badge{display:inline-flex;align-items:center;gap:.25rem;padding:.18rem .55rem;border-radius:20px;font-size:.62rem;font-weight:700;font-family:'Syne',sans-serif}
.b-active{background:rgba(93,230,212,.12);color:var(--teal)}
.b-done{background:rgba(122,240,160,.12);color:var(--success)}
.b-pending{background:rgba(240,192,122,.12);color:var(--warn)}
.b-danger{background:rgba(240,122,122,.12);color:var(--danger)}
.b-admin{background:rgba(176,122,240,.12);color:var(--accent)}

/* BUTTONS */
.btn{display:inline-flex;align-items:center;gap:.4rem;font-family:'Syne',sans-serif;font-weight:700;font-size:.75rem;padding:.5rem 1rem;border-radius:100px;border:none;cursor:pointer;transition:all .15s}
.btn-primary{background:var(--teal);color:#07100f}
.btn-primary:hover{background:var(--teal2);transform:translateY(-1px)}
.btn-ghost{background:transparent;color:var(--text);border:1px solid var(--border)}
.btn-ghost:hover{border-color:var(--teal);color:var(--teal)}
.btn-danger{background:rgba(196,58,58,.1);color:var(--danger);border:1px solid rgba(196,58,58,.2)}
.btn-danger:hover{background:rgba(196,58,58,.2)}
.btn-sm{padding:.32rem .7rem;font-size:.7rem}
.btn-xs{padding:.22rem .55rem;font-size:.65rem}

/* FORMS */
.form-row{display:grid;gap:1rem;margin-bottom:1rem}
.form-row.cols-2{grid-template-columns:1fr 1fr}
.form-row.cols-3{grid-template-columns:1fr 1fr 1fr}
.form-group{display:flex;flex-direction:column;gap:.3rem}
.form-label{font-size:.7rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
.form-input,.form-select,.form-textarea{background:var(--surface2);border:1px solid var(--border);border-radius:9px;color:var(--text);padding:.62rem .9rem;font-family:'DM Sans',sans-serif;font-size:.82rem;outline:none;transition:border-color .15s;width:100%}
.form-input:focus,.form-select:focus,.form-textarea:focus{border-color:var(--teal)}
.form-textarea{resize:vertical;min-height:80px}

/* MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(7,16,15,.7);z-index:200;align-items:center;justify-content:center;backdrop-filter:blur(3px)}
.modal-overlay.open{display:flex}
.modal{background:#fff;border-radius:16px;padding:1.8rem;width:100%;max-width:540px;max-height:90vh;overflow-y:auto;position:relative}
.modal-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.4rem}
.modal-title{font-family:'Syne',sans-serif;font-weight:800;font-size:1.05rem}
.modal-close{background:none;border:none;font-size:1.3rem;cursor:pointer;color:var(--muted);line-height:1}
.modal-close:hover{color:var(--text)}
.modal-footer{display:flex;gap:.7rem;justify-content:flex-end;margin-top:1.4rem;padding-top:1rem;border-top:1px solid var(--border)}

/* SEARCH */
.search-bar{display:flex;align-items:center;gap:.5rem;background:var(--surface2);border:1px solid var(--border);border-radius:9px;padding:.5rem .9rem;font-size:.8rem;color:var(--muted);width:240px}
.search-bar input{background:none;border:none;outline:none;font-size:.8rem;color:var(--text);width:100%;font-family:'DM Sans',sans-serif}

/* TOAST */
#toast{position:fixed;bottom:1.4rem;right:1.4rem;background:#0b1a18;color:#e8f5f3;border:1px solid rgba(93,230,212,.3);border-radius:10px;padding:.65rem 1.1rem;font-size:.8rem;font-family:'Syne',sans-serif;font-weight:600;z-index:9000;transform:translateY(60px);opacity:0;transition:all .3s;max-width:300px}
#toast.show{transform:translateY(0);opacity:1}
#toast.err{border-color:rgba(196,58,58,.4);color:#f07a7a}

/* AVATAR */
.avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--teal3),var(--teal));display:flex;align-items:center;justify-content:center;font-size:.85rem;flex-shrink:0}

/* PROGRESS */
.prog-bar{height:4px;background:var(--surface2);border-radius:3px;overflow:hidden}
.prog-fill{height:100%;background:linear-gradient(90deg,var(--teal3),var(--teal));border-radius:3px;transition:width .6s}

/* EMPTY STATE */
.empty{text-align:center;padding:2.5rem 1rem;color:var(--muted)}
.empty-icon{font-size:2rem;margin-bottom:.6rem}
.empty-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.9rem;color:var(--text);margin-bottom:.3rem}

/* CURSO CHECKBOX — multi-inscripción */
.curso-check-item{display:flex;align-items:center;gap:.8rem;padding:.65rem .9rem;border:1px solid var(--border);border-radius:10px;cursor:pointer;transition:all .15s;user-select:none}
.curso-check-item:hover{border-color:rgba(93,230,212,.35);background:rgba(93,230,212,.04)}
.curso-check-item.selected{border-color:var(--teal);background:rgba(93,230,212,.08)}
.curso-check-item.ya-inscrito{opacity:.55;cursor:not-allowed;pointer-events:none}
.curso-check-item input[type=checkbox]{width:16px;height:16px;accent-color:var(--teal);cursor:pointer;flex-shrink:0}
.curso-check-emoji{font-size:1.4rem;flex-shrink:0}
.curso-check-info{flex:1;min-width:0}
.curso-check-name{font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem}
.curso-check-meta{font-size:.7rem;color:var(--muted);margin-top:.1rem}
.ya-inscrito-tag{font-size:.62rem;font-weight:700;font-family:'Syne',sans-serif;color:var(--teal);background:rgba(93,230,212,.12);padding:.15rem .45rem;border-radius:20px;flex-shrink:0}

/* RESPONSIVE */
@media(max-width:900px){.grid-4{grid-template-columns:repeat(2,1fr)}.grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:700px){.sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}.topbar-burger{display:flex}.grid-2{grid-template-columns:1fr}}
</style>
</head>
<body>

<div id="toast"></div>

<!-- ══ MODALS ══ -->

<!-- Modal: Crear/Editar Usuario -->
<div class="modal-overlay" id="modal-usuario">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modal-usuario-title">Nuevo Usuario</div>
      <button class="modal-close" onclick="closeModal('modal-usuario')">✕</button>
    </div>
    <div class="form-row cols-2">
      <div class="form-group"><label class="form-label">Nombre *</label><input class="form-input" id="u-nombre" placeholder="Carlos"/></div>
      <div class="form-group"><label class="form-label">Apellido *</label><input class="form-input" id="u-apellido" placeholder="Fernández"/></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Email *</label><input class="form-input" id="u-email" type="email" placeholder="correo@ejemplo.com"/></div>
    </div>
    <div class="form-row cols-2">
      <div class="form-group"><label class="form-label">Contraseña</label><input class="form-input" id="u-password" type="password" placeholder="Mínimo 8 caracteres"/></div>
      <div class="form-group"><label class="form-label">Rol *</label>
        <select class="form-select" id="u-rol">
          <option value="estudiante">Estudiante</option>
          <option value="admin">Administrador</option>
          <option value="instructor">instructor</option>
        </select>
      </div>
    </div>
    <div class="form-row cols-2">
      <div class="form-group"><label class="form-label">Profesión</label><input class="form-input" id="u-profesion" placeholder="Ingeniero Civil"/></div>
      <div class="form-group"><label class="form-label">Ciudad</label><input class="form-input" id="u-ciudad" placeholder="Santo Domingo"/></div>
    </div>
    <div class="form-row" id="inscribir-al-crear" style="display:none">
      <div class="form-group"><label class="form-label">Inscribir a curso (opcional)</label>
        <select class="form-select" id="u-curso-id">
          <option value="">-- Sin inscripción --</option>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-usuario')">Cancelar</button>
      <button class="btn btn-primary" onclick="guardarUsuario()">Guardar usuario</button>
    </div>
  </div>
</div>

<!-- Modal: Inscribir a cursos (MULTI-SELECCIÓN) -->
<div class="modal-overlay" id="modal-inscribir">
  <div class="modal" style="max-width:500px">
    <div class="modal-header">
      <div class="modal-title">Inscribir a cursos</div>
      <button class="modal-close" onclick="closeModal('modal-inscribir')">✕</button>
    </div>
    <div style="background:var(--surface2);border-radius:10px;padding:.7rem 1rem;margin-bottom:1.1rem;font-size:.82rem;font-family:'Syne',sans-serif;font-weight:700" id="inscribir-nombre-label">—</div>
    <div class="form-group" style="margin-bottom:1rem">
      <label class="form-label">Selecciona uno o más cursos *</label>
      <div id="ins-cursos-checks" style="display:flex;flex-direction:column;gap:.5rem;max-height:300px;overflow-y:auto;padding:.2rem 0">
        <p style="color:var(--muted);font-size:.8rem;padding:.5rem 0">Cargando cursos...</p>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Estado</label>
      <select class="form-select" id="ins-estado">
        <option value="activo">Activo</option>
        <option value="suspendido">Suspendido</option>
      </select>
    </div>
    <div id="ins-resultado" style="margin-top:.8rem;font-size:.78rem;padding:.5rem .7rem;border-radius:8px;display:none"></div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-inscribir')">Cancelar</button>
      <button class="btn btn-primary" onclick="confirmarInscripcion()">Inscribir seleccionados</button>
    </div>
  </div>
</div>

<!-- Modal: Crear Curso -->
<div class="modal-overlay" id="modal-curso">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modal-curso-title">Nuevo Curso</div>
      <button class="modal-close" onclick="closeModal('modal-curso')">✕</button>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Nombre del curso *</label><input class="form-input" id="c-nombre" placeholder="BIM · Revit"/></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Descripción</label><textarea class="form-textarea" id="c-descripcion" placeholder="Descripción breve del curso..."></textarea></div>
    </div>
    <div class="form-row cols-3">
      <div class="form-group"><label class="form-label">Emoji</label><input class="form-input" id="c-emoji" placeholder="🏗️" maxlength="4" style="font-size:1.3rem;text-align:center"/></div>
      <div class="form-group"><label class="form-label">Color HEX</label><input class="form-input" id="c-color" placeholder="#0d9e8e"/></div>
      <div class="form-group"><label class="form-label">Horas totales</label><input class="form-input" id="c-horas" type="number" placeholder="14" min="0"/></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Instructor (opcional)</label>
        <select class="form-select" id="c-instructor">
          <option value="">-- Sin instructor --</option>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-curso')">Cancelar</button>
      <button class="btn btn-primary" onclick="guardarCurso()">Guardar curso</button>
    </div>
  </div>
</div>

<!-- Modal: Crear Workshop -->
<div class="modal-overlay" id="modal-workshop">
  <div class="modal" style="max-width:460px">
    <div class="modal-header">
      <div class="modal-title">Nuevo Workshop</div>
      <button class="modal-close" onclick="closeModal('modal-workshop')">✕</button>
    </div>
    <p style="font-size:.82rem;color:var(--muted);margin-bottom:1rem" id="ws-curso-label">—</p>
    <div class="form-row cols-2">
      <div class="form-group"><label class="form-label">Número</label><input class="form-input" id="ws-numero" type="number" value="1" min="1"/></div>
      <div class="form-group"><label class="form-label">Orden</label><input class="form-input" id="ws-orden" type="number" value="1" min="1"/></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Título *</label><input class="form-input" id="ws-titulo" placeholder="Introducción al modelado"/></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Descripción</label><textarea class="form-textarea" id="ws-descripcion" placeholder="Descripción del workshop..."></textarea></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Duración (minutos)</label><input class="form-input" id="ws-duracion" type="number" value="90" min="1"/></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-workshop')">Cancelar</button>
      <button class="btn btn-primary" onclick="guardarWorkshop()">Guardar workshop</button>
    </div>
  </div>
</div>

<!-- Modal: Crear Tarea -->
<div class="modal-overlay" id="modal-tarea">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modal-tarea-title">Nueva Tarea</div>
      <button class="modal-close" onclick="closeModal('modal-tarea')">✕</button>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Título *</label><input class="form-input" id="t-titulo" placeholder="Plano estructural en Revit"/></div>
    </div>
    <div class="form-row cols-2">
      <div class="form-group"><label class="form-label">Curso *</label>
        <select class="form-select" id="t-curso-id">
          <option value="">-- Selecciona curso --</option>
        </select>
      </div>
      <div class="form-group"><label class="form-label">Tipo</label>
        <select class="form-select" id="t-tipo">
          <option value="tarea">Tarea</option>
          <option value="quiz">Quiz</option>
          <option value="examen">Examen</option>
          <option value="proyecto">Proyecto</option>
        </select>
      </div>
    </div>
    <div class="form-row cols-2">
      <div class="form-group"><label class="form-label">Fecha límite *</label><input class="form-input" id="t-fecha" type="datetime-local"/></div>
      <div class="form-group"><label class="form-label">Puntos máximos</label><input class="form-input" id="t-puntos" type="number" value="100" min="0"/></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Descripción</label><textarea class="form-textarea" id="t-descripcion" placeholder="Instrucciones de la tarea..."></textarea></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-tarea')">Cancelar</button>
      <button class="btn btn-primary" onclick="guardarTarea()">Guardar tarea</button>
    </div>
  </div>
</div>

<!-- Modal: Calificar entrega -->
<div class="modal-overlay" id="modal-calificar">
  <div class="modal" style="max-width:440px">
    <div class="modal-header">
      <div class="modal-title">Calificar entrega</div>
      <button class="modal-close" onclick="closeModal('modal-calificar')">✕</button>
    </div>
    <div id="entrega-info" style="background:var(--surface2);border-radius:10px;padding:.9rem;margin-bottom:1rem;font-size:.82rem"></div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Calificación (0–100) *</label><input class="form-input" id="cal-nota" type="number" min="0" max="100" placeholder="85"/></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Feedback para el estudiante</label><textarea class="form-textarea" id="cal-feedback" placeholder="Comentario sobre la entrega..."></textarea></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-calificar')">Cancelar</button>
      <button class="btn btn-primary" onclick="confirmarCalificacion()">Guardar calificación</button>
    </div>
  </div>
</div>

<!-- Modal: Emitir Certificado -->
<div class="modal-overlay" id="modal-certificado">
  <div class="modal" style="max-width:420px">
    <div class="modal-header">
      <div class="modal-title">Emitir Certificado</div>
      <button class="modal-close" onclick="closeModal('modal-certificado')">✕</button>
    </div>
    <p style="font-size:.82rem;color:var(--muted);margin-bottom:1rem" id="cert-label">—</p>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Nota final (opcional)</label><input class="form-input" id="cert-nota" type="number" min="0" max="100" placeholder="92"/></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-certificado')">Cancelar</button>
      <button class="btn btn-primary" onclick="confirmarCertificado()">Emitir certificado</button>
    </div>
  </div>
</div>

<!-- ══ SIDEBAR ══ -->
<aside class="sidebar" id="sidebar">
  <a href="#" class="sidebar-logo">
    constructiva<span>.</span>
    <span class="sidebar-badge">ADMIN</span>
  </a>
  <nav class="sidebar-nav">
    <div class="nav-label">Panel</div>
    <a class="nav-item active" data-section="dashboard">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></span>
      Dashboard
    </a>
    <div class="nav-label">Gestión</div>
    <a class="nav-item" data-section="usuarios">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
      Usuarios
      <span class="nav-count" id="cnt-usuarios">—</span>
    </a>
    <a class="nav-item" data-section="cursos">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></span>
      Cursos
      <span class="nav-count" id="cnt-cursos">—</span>
    </a>
    <a class="nav-item" data-section="tareas">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9,11 12,14 22,4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></span>
      Tareas
      <span class="nav-count" id="cnt-tareas">—</span>
    </a>
    <div class="nav-label">En Vivo</div>
    <a class="nav-item" href="/charla" target="_blank">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.869v6.262a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg></span>
      Charlas en Vivo
      <span class="nav-count" id="cnt-charla" style="background:rgba(239,68,68,.2);color:#f07a7a">Admin</span>
    </a>
    <div class="nav-label">Cuenta</div>
    <a class="nav-item" id="btn-logout" style="cursor:pointer">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></span>
      Cerrar sesión
    </a>
  </nav>
  <div class="sidebar-footer">constructiva.edu.do · Admin v1.0</div>
</aside>

<!-- ══ MAIN ══ -->
<div class="main">
  <header class="topbar">
    <button class="topbar-burger" onclick="toggleSidebar()">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <div class="topbar-breadcrumb">constructiva<span> / <span id="breadcrumb">Dashboard</span></span></div>
    <div class="topbar-right">
      <span class="topbar-admin" id="admin-name">Admin</span>
    </div>
  </header>

  <div class="content">

    <!-- ══ DASHBOARD ══ -->
    <div class="section active" id="sec-dashboard">
      <div class="page-header">
        <div class="page-label">Panel de Control</div>
        <h1 class="page-title">Dashboard <em>Admin</em></h1>
        <p class="page-sub" id="dash-sub">Cargando datos...</p>
      </div>
      <div class="grid-4" id="dash-stats">
        <div class="stat-card"><div class="stat-icon teal">👥</div><div><div class="stat-num" id="d-usuarios" style="color:var(--teal)">—</div><div class="stat-label">Usuarios totales</div></div></div>
        <div class="stat-card"><div class="stat-icon purple">📚</div><div><div class="stat-num" id="d-cursos" style="color:var(--accent)">—</div><div class="stat-label">Cursos activos</div></div></div>
        <div class="stat-card"><div class="stat-icon warn">📝</div><div><div class="stat-num" id="d-tareas" style="color:var(--warn)">—</div><div class="stat-label">Tareas creadas</div></div></div>
        <div class="stat-card"><div class="stat-icon success">🏆</div><div><div class="stat-num" id="d-inscripciones" style="color:var(--success)">—</div><div class="stat-label">Inscripciones activas</div></div></div>
      </div>
      <div class="grid-2">
        <div class="card">
          <div class="card-header"><div class="card-title">Últimos usuarios registrados</div><button class="btn btn-ghost btn-sm" onclick="navigate('usuarios')">Ver todos →</button></div>
          <div id="dash-users-list"><div style="color:var(--muted);font-size:.8rem">Cargando...</div></div>
        </div>
        <div class="card">
          <div class="card-header"><div class="card-title">Progreso por curso</div><button class="btn btn-ghost btn-sm" onclick="navigate('cursos')">Ver todos →</button></div>
          <div id="dash-cursos-list"><div style="color:var(--muted);font-size:.8rem">Cargando...</div></div>
        </div>
      </div>
    </div>

    <!-- ══ USUARIOS ══ -->
    <div class="section" id="sec-usuarios">
      <div class="page-header">
        <div class="page-label">Gestión</div>
        <h1 class="page-title">Gestión de <em>Usuarios</em></h1>
      </div>
      <div style="display:flex;align-items:center;gap:.8rem;margin-bottom:1.3rem;flex-wrap:wrap">
        <div class="search-bar">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" id="search-usuarios" placeholder="Buscar por nombre o email..." oninput="filtrarUsuarios(this.value)"/>
        </div>
        <select class="form-select" id="filter-rol" style="width:140px" onchange="loadUsuarios()">
          <option value="">Todos los roles</option>
          <option value="estudiante">Estudiantes</option>
          <option value="admin">Admins</option>
        </select>
        <select class="form-select" id="filter-activo" style="width:140px" onchange="loadUsuarios()">
          <option value="">Todos</option>
          <option value="1">Activos</option>
          <option value="0">Inactivos</option>
        </select>
        <button class="btn btn-primary" style="margin-left:auto" onclick="abrirModalNuevoUsuario()">+ Nuevo usuario</button>
      </div>
      <div class="card">
        <table class="data-table" id="tabla-usuarios">
          <thead><tr><th>Usuario</th><th>Email</th><th>Rol</th><th>Inscripciones</th><th>Estado</th><th>Registrado</th><th></th></tr></thead>
          <tbody id="tbody-usuarios"></tbody>
        </table>
      </div>
    </div>

    <!-- ══ CURSOS ══ -->
    <div class="section" id="sec-cursos">
      <div class="page-header">
        <div class="page-label">Gestión</div>
        <h1 class="page-title">Gestión de <em>Cursos</em></h1>
      </div>
      <div style="display:flex;justify-content:flex-end;margin-bottom:1.3rem">
        <button class="btn btn-primary" onclick="abrirModalNuevoCurso()">+ Nuevo curso</button>
      </div>
      <div class="grid-3" id="grid-cursos"></div>
    </div>

    <!-- ══ TAREAS ══ -->
    <div class="section" id="sec-tareas">
      <div class="page-header">
        <div class="page-label">Gestión Académica</div>
        <h1 class="page-title">Tareas y <em>Evaluaciones</em></h1>
      </div>
      <div style="display:flex;align-items:center;gap:.8rem;margin-bottom:1.3rem;flex-wrap:wrap">
        <select class="form-select" id="filter-tarea-curso" style="width:200px" onchange="loadTareas()">
          <option value="">Todos los cursos</option>
        </select>
        <button class="btn btn-primary" style="margin-left:auto" onclick="abrirModalNuevaTarea()">+ Nueva tarea</button>
      </div>
      <div class="card">
        <table class="data-table">
          <thead><tr><th>Tarea</th><th>Curso</th><th>Tipo</th><th>Vence</th><th>Entregas</th><th>Promedio</th><th></th></tr></thead>
          <tbody id="tbody-tareas"></tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<script>
const API = 'Php';

// ══ HELPERS ══
function toast(msg, err=false) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'show' + (err ? ' err' : '');
  clearTimeout(t._t);
  t._t = setTimeout(() => t.className='', 3500);
}

async function apiFetch(ep, opts={}) {
  const res = await fetch(`${API}/${ep}`, {
    credentials: 'include',
    headers: {'Content-Type':'application/json', ...opts.headers},
    ...opts
  });
  const json = await res.json();
  if (!json.ok) throw new Error(json.error || 'Error');
  return json.data;
}

function fmtDate(s) {
  if (!s) return '—';
  const d = new Date(s);
  return d.toLocaleDateString('es-DO', {day:'2-digit', month:'short', year:'numeric'});
}

function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(m => {
  m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
});

// ══ NAVEGACIÓN ══
const LABELS = {dashboard:'Dashboard', usuarios:'Usuarios', cursos:'Cursos', tareas:'Tareas'};
function navigate(id) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item[data-section]').forEach(n => n.classList.remove('active'));
  document.getElementById('sec-'+id)?.classList.add('active');
  document.querySelector(`.nav-item[data-section="${id}"]`)?.classList.add('active');
  document.getElementById('breadcrumb').textContent = LABELS[id] || id;
  document.getElementById('sidebar').classList.remove('open');
}
document.querySelectorAll('.nav-item[data-section]').forEach(n => {
  n.addEventListener('click', () => navigate(n.dataset.section));
});

function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); }

// ══ LOGOUT ══
document.getElementById('btn-logout').addEventListener('click', () => {
  document.cookie = 'cv_token=;expires=Thu,01 Jan 1970 00:00:00 GMT;path=/';
  window.location.href = 'index.php';
});

// ══ ESTADO GLOBAL ══
let todosUsuarios = [], todosCursos = [], todasTareas = [];
let editUsuarioId = null, editCursoId = null, editTareaId = null;
let inscribirUsuarioId = null, wsCursoId = null;
let certUsuarioId = null, certCursoId = null;

// ══════════════════════════════════════════════
//  DASHBOARD
// ══════════════════════════════════════════════
async function loadDashboard() {
  const [uData, cData, tData] = await Promise.all([
    apiFetch('adminusuario.php'),
    apiFetch('admincurso.php'),
    apiFetch('admintarea.php')
  ]);

  const inscActivas = uData.usuarios.reduce((s, u) => s + (parseInt(u.inscripciones_activas)||0), 0);

  document.getElementById('d-usuarios').textContent      = uData.stats.total;
  document.getElementById('d-cursos').textContent        = cData.stats.activos;
  document.getElementById('d-tareas').textContent        = tData.stats.total;
  document.getElementById('d-inscripciones').textContent = inscActivas;

  const now = new Date();
  document.getElementById('dash-sub').textContent =
    `${now.toLocaleDateString('es-DO',{weekday:'long',day:'numeric',month:'long'})} · ${uData.stats.estudiantes} estudiantes`;

  const ul = document.getElementById('dash-users-list');
  ul.innerHTML = uData.usuarios.slice(0,5).map(u => `
    <div style="display:flex;align-items:center;gap:.8rem;padding:.6rem 0;border-bottom:1px solid var(--border)">
      <div class="avatar">${u.avatar_emoji||'👤'}</div>
      <div style="flex:1;min-width:0">
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem">${u.nombre} ${u.apellido}</div>
        <div style="font-size:.7rem;color:var(--muted)">${u.email}</div>
      </div>
      <span class="badge ${u.rol==='admin'?'b-admin':'b-active'}">${u.rol}</span>
    </div>`).join('') || '<p style="color:var(--muted);font-size:.8rem">Sin usuarios</p>';

  const cl = document.getElementById('dash-cursos-list');
  cl.innerHTML = cData.cursos.slice(0,4).map(c => `
    <div style="padding:.6rem 0;border-bottom:1px solid var(--border)">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.3rem">
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem">${c.emoji||'📚'} ${c.nombre}</div>
        <span style="font-size:.72rem;color:var(--teal);font-weight:700">${c.total_inscritos} inscritos</span>
      </div>
      <div class="prog-bar"><div class="prog-fill" style="width:${c.progreso_promedio||0}%"></div></div>
    </div>`).join('') || '<p style="color:var(--muted);font-size:.8rem">Sin cursos</p>';
}

// ══════════════════════════════════════════════
//  USUARIOS
// ══════════════════════════════════════════════
async function loadUsuarios() {
  const rol    = document.getElementById('filter-rol')?.value || '';
  const activo = document.getElementById('filter-activo')?.value ?? '';
  let ep = 'adminusuario.php?';
  if (rol)           ep += `rol=${rol}&`;
  if (activo !== '') ep += `activo=${activo}&`;
  const data = await apiFetch(ep);
  todosUsuarios = data.usuarios;
  document.getElementById('cnt-usuarios').textContent = data.stats.total;
  renderUsuarios(todosUsuarios);
}

function filtrarUsuarios(q) {
  if (!q) return renderUsuarios(todosUsuarios);
  const f = q.toLowerCase();
  renderUsuarios(todosUsuarios.filter(u =>
    (u.nombre+' '+u.apellido+' '+u.email).toLowerCase().includes(f)
  ));
}

function renderUsuarios(lista) {
  const tb = document.getElementById('tbody-usuarios');
  if (!lista.length) {
    tb.innerHTML = '<tr><td colspan="7"><div class="empty"><div class="empty-icon">👤</div><div class="empty-title">Sin usuarios</div></div></td></tr>';
    return;
  }
  tb.innerHTML = lista.map(u => `
    <tr>
      <td>
        <div style="display:flex;align-items:center;gap:.7rem">
          <div class="avatar">${u.avatar_emoji||'👤'}</div>
          <div>
            <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem">${u.nombre} ${u.apellido}</div>
            <div style="font-size:.68rem;color:var(--muted)">${u.profesion||'—'}</div>
          </div>
        </div>
      </td>
      <td style="font-size:.78rem">${u.email}</td>
      <td><span class="badge ${u.rol==='admin'?'b-admin':'b-active'}">${u.rol}</span></td>
      <td style="font-size:.78rem;text-align:center">${u.inscripciones_activas||0}</td>
      <td><span class="badge ${u.activo?'b-active':'b-danger'}">${u.activo?'Activo':'Inactivo'}</span></td>
      <td style="font-size:.75rem;color:var(--muted)">${fmtDate(u.created_at)}</td>
      <td>
        <div style="display:flex;gap:.4rem">
          <button class="btn btn-ghost btn-xs" onclick="abrirModalEditarUsuario(${u.id})">Editar</button>
          <button class="btn btn-xs" style="background:rgba(93,230,212,.1);color:var(--teal);border:1px solid rgba(93,230,212,.2)" onclick="abrirModalInscribir(${u.id},'${u.nombre} ${u.apellido}')">+ Inscribir</button>
          <button class="btn btn-danger btn-xs" onclick="desactivarUsuario(${u.id},'${u.nombre}')">${u.activo?'Desactivar':'Activar'}</button>
        </div>
      </td>
    </tr>`).join('');
}

function abrirModalNuevoUsuario() {
  editUsuarioId = null;
  document.getElementById('modal-usuario-title').textContent = 'Nuevo Usuario';
  ['u-nombre','u-apellido','u-email','u-password','u-profesion','u-ciudad'].forEach(id => document.getElementById(id).value='');
  document.getElementById('u-rol').value = 'estudiante';
  document.getElementById('inscribir-al-crear').style.display = 'block';
  const sel = document.getElementById('u-curso-id');
  sel.innerHTML = '<option value="">-- Sin inscripción --</option>' + todosCursos.map(c => `<option value="${c.id}">${c.emoji||''} ${c.nombre}</option>`).join('');
  openModal('modal-usuario');
}

async function abrirModalEditarUsuario(id) {
  editUsuarioId = id;
  document.getElementById('modal-usuario-title').textContent = 'Editar Usuario';
  document.getElementById('inscribir-al-crear').style.display = 'none';
  try {
    const u = await apiFetch(`adminusuario.php?id=${id}`);
    document.getElementById('u-nombre').value    = u.nombre    || '';
    document.getElementById('u-apellido').value  = u.apellido  || '';
    document.getElementById('u-email').value     = u.email     || '';
    document.getElementById('u-profesion').value = u.profesion || '';
    document.getElementById('u-ciudad').value    = u.ciudad    || '';
    document.getElementById('u-rol').value       = u.rol       || 'estudiante';
    document.getElementById('u-password').value  = '';
    openModal('modal-usuario');
  } catch(e) { toast(e.message, true); }
}

async function guardarUsuario() {
  const body = {
    nombre:    document.getElementById('u-nombre').value.trim(),
    apellido:  document.getElementById('u-apellido').value.trim(),
    email:     document.getElementById('u-email').value.trim(),
    password:  document.getElementById('u-password').value,
    rol:       document.getElementById('u-rol').value,
    profesion: document.getElementById('u-profesion').value.trim(),
    ciudad:    document.getElementById('u-ciudad').value.trim(),
  };
  if (!body.nombre || !body.apellido || !body.email) return toast('Nombre, apellido y email son requeridos', true);
  if (!editUsuarioId && !body.password) return toast('La contraseña es requerida al crear', true);

  if (!editUsuarioId) {
    const cursoId = document.getElementById('u-curso-id').value;
    if (cursoId) body.curso_id = parseInt(cursoId);
  }

  try {
    const method = editUsuarioId ? 'PUT' : 'POST';
    const ep     = editUsuarioId ? `adminusuario.php?id=${editUsuarioId}` : 'adminusuario.php';
    const r = await apiFetch(ep, { method, body: JSON.stringify(body) });
    toast('✅ ' + r.mensaje);
    closeModal('modal-usuario');
    await loadUsuarios();
    await loadDashboard();
  } catch(e) { toast(e.message, true); }
}

// ══ INSCRIPCIÓN MULTI-CURSO ══
async function abrirModalInscribir(userId, nombre) {
  inscribirUsuarioId = userId;
  document.getElementById('inscribir-nombre-label').textContent = `👤 ${nombre}`;
  document.getElementById('ins-estado').value = 'activo';
  const res = document.getElementById('ins-resultado');
  res.style.display = 'none';
  res.textContent = '';

  const contenedor = document.getElementById('ins-cursos-checks');
  contenedor.innerHTML = '<p style="color:var(--muted);font-size:.8rem;padding:.4rem 0">Cargando cursos...</p>';
  openModal('modal-inscribir');

  try {
    // Cargar cursos si aún no se han cargado
    if (!todosCursos.length) {
      const data = await apiFetch('admincurso.php');
      todosCursos = data.cursos;
    }

    // Cursos en los que ya está inscrito
    const uDetalle   = await apiFetch(`adminusuario.php?id=${userId}`);
    const yaInscritos = new Set((uDetalle.inscripciones || []).map(i => Number(i.curso_id)));

    const activos = todosCursos.filter(c => c.activo == 1);

    if (!activos.length) {
      contenedor.innerHTML = '<p style="color:var(--muted);font-size:.8rem">No hay cursos activos disponibles.</p>';
      return;
    }

    contenedor.innerHTML = activos.map(c => {
      const inscrito = yaInscritos.has(Number(c.id));
      return `
      <label class="curso-check-item${inscrito ? ' ya-inscrito' : ''}" for="chk-${c.id}">
        <input type="checkbox" id="chk-${c.id}" value="${c.id}"
          ${inscrito ? 'checked disabled' : ''}
          onchange="this.closest('.curso-check-item').classList.toggle('selected', this.checked)"/>
        <span class="curso-check-emoji">${c.emoji || '📚'}</span>
        <div class="curso-check-info">
          <div class="curso-check-name">${c.nombre}</div>
          <div class="curso-check-meta">${c.total_workshops||0} workshops · ${c.horas_totales||0}h · ${c.total_inscritos||0} inscritos</div>
        </div>
        ${inscrito ? '<span class="ya-inscrito-tag">Ya inscrito</span>' : ''}
      </label>`;
    }).join('');

  } catch(e) {
    contenedor.innerHTML = `<p style="color:var(--danger);font-size:.8rem">Error: ${e.message}</p>`;
  }
}

async function confirmarInscripcion() {
  const estado   = document.getElementById('ins-estado').value;
  const checks   = document.querySelectorAll('#ins-cursos-checks input[type=checkbox]:not(:disabled):checked');
  const cursoIds = Array.from(checks).map(c => parseInt(c.value));

  if (!cursoIds.length) return toast('Selecciona al menos un curso', true);

  const res = document.getElementById('ins-resultado');
  res.style.display = 'block';
  res.style.background = 'var(--surface2)';
  res.textContent = `Inscribiendo en ${cursoIds.length} curso(s)...`;

  let ok = 0;
  const errores = [];

  for (const cursoId of cursoIds) {
    try {
      await apiFetch('adminusuario.php?action=inscribir', {
        method: 'POST',
        body: JSON.stringify({ usuario_id: inscribirUsuarioId, curso_id: cursoId, estado })
      });
      ok++;
    } catch(e) {
      const nombre = todosCursos.find(c => c.id === cursoId)?.nombre || `Curso ${cursoId}`;
      errores.push(`${nombre}: ${e.message}`);
    }
  }

  if (ok > 0) {
    toast(`✅ ${ok} inscripción(es) realizadas correctamente`);
    res.style.background = 'rgba(122,240,160,.1)';
    res.textContent = `✅ ${ok} curso(s) inscritos.${errores.length ? ' Errores: '+errores.join(' | ') : ''}`;
    await loadUsuarios();
    setTimeout(() => closeModal('modal-inscribir'), 1400);
  } else {
    res.style.background = 'rgba(240,122,122,.08)';
    res.textContent = `Error: ${errores.join(' | ')}`;
  }
}

async function desactivarUsuario(id, nombre) {
  if (!confirm(`¿Desactivar/activar a ${nombre}?`)) return;
  try {
    const u = todosUsuarios.find(x => x.id === id);
    if (u && !u.activo) {
      await apiFetch(`adminusuario.php?id=${id}`, { method: 'PUT', body: JSON.stringify({...u, activo: 1}) });
      toast('✅ Usuario activado');
    } else {
      await apiFetch(`adminusuario.php?id=${id}`, { method: 'DELETE' });
      toast('✅ Usuario desactivado');
    }
    await loadUsuarios();
  } catch(e) { toast(e.message, true); }
}

// ══════════════════════════════════════════════
//  CURSOS
// ══════════════════════════════════════════════
async function loadCursos() {
  const data = await apiFetch('admincurso.php');
  todosCursos = data.cursos;
  document.getElementById('cnt-cursos').textContent = data.stats.activos;

  // Solo instructores
  try {
    const instData = await apiFetch('adminusuario.php?rol=instructor&activo=1');
    const instructores = (instData.usuarios || []).sort((a,b) => a.nombre.localeCompare(b.nombre));
    const cInst = document.getElementById('c-instructor');
    if (cInst) cInst.innerHTML = '<option value="">-- Sin instructor --</option>'
      + instructores.map(a => `<option value="${a.id}">${a.nombre} ${a.apellido}</option>`).join('');
  } catch(_) {}

  const filtTarea = document.getElementById('filter-tarea-curso');
  if (filtTarea) filtTarea.innerHTML = '<option value="">Todos los cursos</option>' + todosCursos.map(c => `<option value="${c.id}">${c.emoji||''} ${c.nombre}</option>`).join('');
  const tSel = document.getElementById('t-curso-id');
  if (tSel) tSel.innerHTML = '<option value="">-- Selecciona curso --</option>' + todosCursos.map(c => `<option value="${c.id}">${c.emoji||''} ${c.nombre}</option>`).join('');
  renderCursos(todosCursos);
}

function renderCursos(lista) {
  const grid = document.getElementById('grid-cursos');
  if (!lista.length) {
    grid.innerHTML = '<div class="empty" style="grid-column:1/-1"><div class="empty-icon">📚</div><div class="empty-title">Sin cursos</div></div>';
    return;
  }
  grid.innerHTML = lista.map(c => `
    <div class="card">
      <div style="height:90px;border-radius:10px;background:${c.color_hex||'#0d9e8e'}22;display:flex;align-items:center;justify-content:center;font-size:2.5rem;margin-bottom:.9rem">${c.emoji||'📚'}</div>
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.4rem">
        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:.92rem;flex:1">${c.nombre}</div>
        <span class="badge ${c.activo?'b-active':'b-danger'}">${c.activo?'Activo':'Inactivo'}</span>
      </div>
      <div style="font-size:.75rem;color:var(--muted);margin-bottom:.8rem">${c.total_workshops||0} workshops · ${c.horas_totales||0}h · ${c.total_inscritos||0} inscritos</div>
      <div class="prog-bar" style="margin-bottom:.8rem"><div class="prog-fill" style="width:${c.progreso_promedio||0}%"></div></div>
      <div style="display:flex;gap:.4rem;flex-wrap:wrap">
        <button class="btn btn-ghost btn-xs" onclick="abrirModalEditarCurso(${c.id})">Editar</button>
        <button class="btn btn-xs" style="background:rgba(93,230,212,.1);color:var(--teal)" onclick="abrirModalWorkshop(${c.id},'${c.nombre}')">+ Workshop</button>
        <button class="btn btn-xs" style="background:rgba(122,240,160,.1);color:var(--success)" onclick="verDetalleCurso(${c.id})">Inscritos</button>
      </div>
    </div>`).join('');
}

function abrirModalNuevoCurso() {
  editCursoId = null;
  document.getElementById('modal-curso-title').textContent = 'Nuevo Curso';
  ['c-nombre','c-descripcion','c-emoji','c-color','c-horas'].forEach(id => document.getElementById(id).value = '');
  document.getElementById('c-emoji').value = '📚';
  document.getElementById('c-color').value = '#0d9e8e';
  openModal('modal-curso');
}

async function abrirModalEditarCurso(id) {
  editCursoId = id;
  document.getElementById('modal-curso-title').textContent = 'Editar Curso';
  try {
    const c = await apiFetch(`admincurso.php?id=${id}`);
    document.getElementById('c-nombre').value      = c.nombre        || '';
    document.getElementById('c-descripcion').value = c.descripcion   || '';
    document.getElementById('c-emoji').value       = c.emoji         || '📚';
    document.getElementById('c-color').value       = c.color_hex     || '#0d9e8e';
    document.getElementById('c-horas').value       = c.horas_totales || 0;
    if (document.getElementById('c-instructor')) document.getElementById('c-instructor').value = c.instructor_id || '';
    openModal('modal-curso');
  } catch(e) { toast(e.message, true); }
}

async function guardarCurso() {
  const body = {
    nombre:        document.getElementById('c-nombre').value.trim(),
    descripcion:   document.getElementById('c-descripcion').value.trim(),
    emoji:         document.getElementById('c-emoji').value.trim() || '📚',
    color_hex:     document.getElementById('c-color').value.trim() || '#0d9e8e',
    horas_totales: parseFloat(document.getElementById('c-horas').value) || 0,
    instructor_id: document.getElementById('c-instructor')?.value || null,
  };
  if (!body.nombre) return toast('El nombre es requerido', true);
  try {
    const method = editCursoId ? 'PUT' : 'POST';
    const ep     = editCursoId ? `admincurso.php?id=${editCursoId}` : 'admincurso.php';
    const r = await apiFetch(ep, { method, body: JSON.stringify(body) });
    toast('✅ ' + r.mensaje);
    closeModal('modal-curso');
    await loadCursos();
    await loadDashboard();
  } catch(e) { toast(e.message, true); }
}

function abrirModalWorkshop(cursoId, cursoNombre) {
  wsCursoId = cursoId;
  document.getElementById('ws-curso-label').textContent = `Curso: ${cursoNombre}`;
  ['ws-titulo','ws-descripcion'].forEach(id => document.getElementById(id).value = '');
  document.getElementById('ws-numero').value   = 1;
  document.getElementById('ws-orden').value    = 1;
  document.getElementById('ws-duracion').value = 90;
  openModal('modal-workshop');
}

async function guardarWorkshop() {
  const body = {
    curso_id:     wsCursoId,
    titulo:       document.getElementById('ws-titulo').value.trim(),
    descripcion:  document.getElementById('ws-descripcion').value.trim(),
    numero:       parseInt(document.getElementById('ws-numero').value) || 1,
    orden:        parseInt(document.getElementById('ws-orden').value) || 1,
    duracion_min: parseInt(document.getElementById('ws-duracion').value) || 90,
  };
  if (!body.titulo) return toast('El título es requerido', true);
  try {
    const r = await apiFetch('admincurso.php?action=workshop', { method:'POST', body:JSON.stringify(body) });
    toast('✅ ' + r.mensaje);
    closeModal('modal-workshop');
    await loadCursos();
  } catch(e) { toast(e.message, true); }
}

async function verDetalleCurso(id) {
  try {
    const c = await apiFetch(`admincurso.php?id=${id}`);
    const rows = c.inscritos.map(u => `
      <tr>
        <td><div style="display:flex;align-items:center;gap:.6rem">
          <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#0d6e64,#0d9e8e);display:flex;align-items:center;justify-content:center;font-size:.75rem">${u.avatar_emoji||'👤'}</div>
          <span style="font-size:.8rem;font-weight:500">${u.nombre} ${u.apellido}</span>
        </div></td>
        <td><span style="font-size:.72rem;padding:.15rem .5rem;border-radius:20px;font-weight:700;background:${u.estado==='activo'?'rgba(93,230,212,.12)':u.estado==='finalizado'?'rgba(122,240,160,.12)':'rgba(240,122,122,.12)'};color:${u.estado==='activo'?'#0d9e8e':u.estado==='finalizado'?'#1a8a40':'#c43a3a'}">${u.estado}</span></td>
        <td>
          <div style="display:flex;align-items:center;gap:.5rem">
            <div style="flex:1;height:4px;background:#e6f0ee;border-radius:3px;min-width:60px"><div style="height:100%;width:${u.progreso||0}%;background:linear-gradient(90deg,#0d6e64,#0d9e8e);border-radius:3px"></div></div>
            <span style="font-size:.72rem;color:#0d9e8e;font-weight:700">${u.progreso||0}%</span>
          </div>
        </td>
        <td style="font-size:.75rem">${u.fecha_inscripcion ? new Date(u.fecha_inscripcion).toLocaleDateString('es-DO') : '—'}</td>
        <td><button onclick="window.opener && window.opener.abrirCertDesdeVentana(${u.usuario_id},'${u.nombre} ${u.apellido}',${id},'${c.nombre}')" style="background:rgba(122,240,160,.15);color:#1a8a40;border:1px solid rgba(122,240,160,.3);padding:.25rem .65rem;border-radius:20px;cursor:pointer;font-size:.72rem;font-weight:700">🏆 Cert.</button></td>
      </tr>`).join('');

    const win = window.open('', '_blank', 'width=700,height=520');
    win.document.write(`<!DOCTYPE html><html><head><title>Inscritos - ${c.nombre}</title>
      <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
      <style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:'DM Sans',sans-serif;padding:1.5rem;color:#0f1f1d;background:#fff}h2{font-family:'Syne',sans-serif;font-size:1.2rem;margin-bottom:.3rem}p{color:#888;font-size:.82rem;margin-bottom:1.2rem}table{width:100%;border-collapse:collapse;font-size:.82rem}th{text-align:left;padding:.6rem .8rem;border-bottom:2px solid #e6f0ee;font-family:'Syne',sans-serif;font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#888}td{padding:.65rem .8rem;border-bottom:1px solid #f3f8f7;vertical-align:middle}</style>
      </head><body>
      <h2>${c.emoji||'📚'} ${c.nombre}</h2>
      <p>${c.inscritos.length} estudiante(s) inscrito(s)</p>
      <table><thead><tr><th>Estudiante</th><th>Estado</th><th>Progreso</th><th>Inscrito</th><th>Acción</th></tr></thead>
      <tbody>${rows || '<tr><td colspan="5" style="text-align:center;color:#888;padding:1.5rem">Sin inscritos aún</td></tr>'}</tbody></table>
      </body></html>`);
  } catch(e) { toast(e.message, true); }
}

// Permite emitir cert desde ventana hija
window.abrirCertDesdeVentana = function(userId, nombre, cursoId, cursoNombre) {
  abrirModalCertificado(userId, nombre, cursoId, cursoNombre);
};

// ══════════════════════════════════════════════
//  TAREAS
// ══════════════════════════════════════════════
async function loadTareas() {
  const cursoId = document.getElementById('filter-tarea-curso')?.value || '';
  const ep = cursoId ? `admintarea.php?curso_id=${cursoId}` : 'admintarea.php';
  const data = await apiFetch(ep);
  todasTareas = data.tareas;
  document.getElementById('cnt-tareas').textContent = data.stats.total;
  renderTareas(todasTareas);
}

function renderTareas(lista) {
  const tb = document.getElementById('tbody-tareas');
  if (!lista.length) {
    tb.innerHTML = '<tr><td colspan="7"><div class="empty"><div class="empty-icon">📝</div><div class="empty-title">Sin tareas</div></div></td></tr>';
    return;
  }
  const tipoColor = {tarea:'b-pending', quiz:'b-active', examen:'b-danger', proyecto:'b-admin'};
  tb.innerHTML = lista.map(t => {
    const vencida = new Date(t.fecha_limite) < new Date();
    return `<tr>
      <td><strong style="font-size:.82rem">${t.titulo}</strong></td>
      <td style="font-size:.78rem">${t.curso_emoji||''} ${t.curso_nombre}</td>
      <td><span class="badge ${tipoColor[t.tipo]||'b-pending'}">${t.tipo}</span></td>
      <td style="font-size:.75rem;color:${vencida?'var(--danger)':'var(--warn)'}">${fmtDate(t.fecha_limite)}</td>
      <td style="font-size:.78rem;text-align:center">${t.total_entregas||0}/${t.total_inscritos||0}</td>
      <td style="font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem;color:var(--success)">${t.promedio!==null?t.promedio:'—'}</td>
      <td><div style="display:flex;gap:.4rem">
        <button class="btn btn-ghost btn-xs" onclick="abrirModalEditarTarea(${t.id})">Editar</button>
        <button class="btn btn-xs" style="background:rgba(93,230,212,.1);color:var(--teal)" onclick="verEntregas(${t.id})">Ver entregas</button>
      </div></td>
    </tr>`;
  }).join('');
}

function abrirModalNuevaTarea() {
  editTareaId = null;
  document.getElementById('modal-tarea-title').textContent = 'Nueva Tarea';
  ['t-titulo','t-descripcion'].forEach(id => document.getElementById(id).value='');
  document.getElementById('t-tipo').value     = 'tarea';
  document.getElementById('t-puntos').value   = 100;
  document.getElementById('t-fecha').value    = '';
  document.getElementById('t-curso-id').value = '';
  openModal('modal-tarea');
}

async function abrirModalEditarTarea(id) {
  editTareaId = id;
  document.getElementById('modal-tarea-title').textContent = 'Editar Tarea';
  try {
    const t = await apiFetch(`admintarea.php?id=${id}`);
    document.getElementById('t-titulo').value      = t.titulo      || '';
    document.getElementById('t-descripcion').value = t.descripcion || '';
    document.getElementById('t-tipo').value        = t.tipo        || 'tarea';
    document.getElementById('t-puntos').value      = t.puntos_max  || 100;
    document.getElementById('t-curso-id').value    = t.curso_id    || '';
    if (t.fecha_limite) {
      document.getElementById('t-fecha').value = t.fecha_limite.replace(' ','T').slice(0,16);
    }
    openModal('modal-tarea');
  } catch(e) { toast(e.message, true); }
}

async function guardarTarea() {
  const body = {
    curso_id:     parseInt(document.getElementById('t-curso-id').value),
    titulo:       document.getElementById('t-titulo').value.trim(),
    descripcion:  document.getElementById('t-descripcion').value.trim(),
    tipo:         document.getElementById('t-tipo').value,
    fecha_limite: document.getElementById('t-fecha').value.replace('T',' ') + ':00',
    puntos_max:   parseInt(document.getElementById('t-puntos').value) || 100,
  };
  if (!body.curso_id)  return toast('Selecciona un curso', true);
  if (!body.titulo)    return toast('El título es requerido', true);
  if (!document.getElementById('t-fecha').value) return toast('La fecha límite es requerida', true);
  try {
    const method = editTareaId ? 'PUT' : 'POST';
    const ep     = editTareaId ? `admintarea.php?id=${editTareaId}` : 'admintarea.php';
    const r = await apiFetch(ep, { method, body: JSON.stringify(body) });
    toast('✅ ' + r.mensaje);
    closeModal('modal-tarea');
    await loadTareas();
    await loadDashboard();
  } catch(e) { toast(e.message, true); }
}

async function verEntregas(tareaId) {
  try {
    const t = await apiFetch(`admintarea.php?id=${tareaId}`);
    const rows = t.entregas.map(e => `
      <tr>
        <td><strong>${e.nombre} ${e.apellido}</strong><br><span style="font-size:.72rem;color:#666">${e.email}</span></td>
        <td style="font-size:.78rem;max-width:200px">${e.comentario||'Sin comentario'}</td>
        <td style="font-size:.75rem">${e.entregada_en ? new Date(e.entregada_en).toLocaleDateString('es-DO') : '—'}</td>
        <td style="font-weight:700;color:#1a8a40">${e.calificacion!==null ? e.calificacion+'/'+t.puntos_max : '—'}</td>
        <td>
          ${e.estado !== 'calificada'
            ? `<button onclick="calificar(${e.id},'${e.nombre} ${e.apellido}',${t.puntos_max})" style="background:#0d9e8e;color:#fff;border:none;padding:.3rem .75rem;border-radius:20px;cursor:pointer;font-size:.72rem;font-weight:700">Calificar</button>`
            : `<span style="color:#1a8a40;font-size:.75rem;font-weight:700">✓ Calificada</span>`
          }
        </td>
      </tr>`).join('');

    const noRows = t.sin_entregar.map(u => `
      <tr style="opacity:.5">
        <td><strong>${u.nombre} ${u.apellido}</strong></td>
        <td colspan="3" style="color:#b86e00;font-size:.78rem">Sin entrega</td>
        <td></td>
      </tr>`).join('');

    const win = window.open('', '_blank', 'width=820,height:580');
    win.document.write(`<!DOCTYPE html><html><head><title>Entregas · ${t.titulo}</title>
      <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
      <style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:'DM Sans',sans-serif;padding:1.5rem;color:#0f1f1d}h2{font-family:'Syne',sans-serif;font-size:1.1rem;margin-bottom:.25rem}p{color:#888;font-size:.82rem;margin-bottom:1.2rem}table{width:100%;border-collapse:collapse;font-size:.82rem}th{text-align:left;padding:.55rem .8rem;border-bottom:2px solid #e6f0ee;font-family:'Syne',sans-serif;font-size:.67rem;text-transform:uppercase;letter-spacing:.08em;color:#888}td{padding:.65rem .8rem;border-bottom:1px solid #f3f8f7;vertical-align:middle}</style>
      </head><body>
      <h2>${t.titulo}</h2>
      <p>${t.curso_emoji||''} ${t.curso_nombre} &nbsp;·&nbsp; ${t.entregas.length} entregada(s) &nbsp;·&nbsp; ${t.sin_entregar.length} pendiente(s)</p>
      <table><thead><tr><th>Estudiante</th><th>Comentario</th><th>Entregada</th><th>Nota</th><th>Acción</th></tr></thead>
      <tbody>${rows}${noRows}</tbody></table>
      <script>
        function calificar(id, nombre, ptsMax) {
          const nota = prompt('Calificación para ' + nombre + ' (0-' + ptsMax + '):');
          if (nota === null || nota.trim() === '') return;
          const fb = prompt('Feedback para el estudiante (opcional):') || '';
          fetch('../Php/admintarea.php?action=calificar', {
            method: 'PUT',
            credentials: 'include',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({entrega_id: id, calificacion: parseFloat(nota), feedback: fb})
          }).then(r => r.json()).then(d => {
            if (d.ok) { alert('✅ Calificación guardada'); location.reload(); }
            else alert('Error: ' + (d.error || 'desconocido'));
          }).catch(() => alert('Error de conexión'));
        }
      <\/script>
      </body></html>`);
  } catch(e) { toast(e.message, true); }
}

// ══ CERTIFICADOS ══
function abrirModalCertificado(userId, nombre, cursoId, cursoNombre) {
  certUsuarioId = userId;
  certCursoId   = cursoId;
  document.getElementById('cert-label').textContent = `${nombre} → ${cursoNombre}`;
  document.getElementById('cert-nota').value = '';
  openModal('modal-certificado');
}

async function confirmarCertificado() { 
  const nota = document.getElementById('cert-nota').value;
  try {
    const r = await apiFetch('admincurso.php?action=certificado', {
      method: 'POST',
      body: JSON.stringify({ usuario_id: certUsuarioId, curso_id: certCursoId, nota_final: nota || null })
    });
    toast('✅ ' + r.mensaje + ' · Código: ' + r.codigo);
    closeModal('modal-certificado');
  } catch(e) { toast(e.message, true); }
}

// ══ INIT ══
// Recargar datos al navegar a cada sección
const _origNavigate = navigate;
navigate = function(id) {
  _origNavigate(id);
  if (id === 'cursos')   loadCursos();
  if (id === 'usuarios') loadUsuarios();
  if (id === 'tareas')   loadTareas();
};

// Arranque inicial
(async () => {
  try {
    await loadDashboard();
    await loadUsuarios();  // necesario antes de loadCursos (filtra instructores)
    await loadCursos();    // puebla el grid de cursos
    await loadTareas();    // puebla la tabla de tareas

    // Nombre del admin en topbar
    try {
      const pr = await fetch('Php/perfil.php', { credentials: 'include' });
      const pj = await pr.json();
      if (pj.ok) document.getElementById('admin-name').textContent = pj.data.nombre + ' ' + pj.data.apellido;
    } catch(_) {}
  } catch(e) {
    toast('Error al cargar datos: ' + e.message, true);
  }
})();

</script>
</body>
</html>