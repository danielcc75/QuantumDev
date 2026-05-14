    <style>
        html {
            scroll-behavior: smooth;
        }

        #sidebar-izquierdo,
        #sidebar-derecho {
            scroll-behavior: smooth;
        }

        .seccion-contenido {
            scroll-margin-top: 6rem;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .sidebar-item:hover {
            transform: translateX(5px);
            background: rgba(0,0,0,0.05);
        }

        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }

        .right-sidebar-item:hover {
            background: #f3f4f6;
            transform: translateX(-3px);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        html, body {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .main-container {
            min-height: calc(100vh - 4rem);
        }

    </style>
