

<body>
<div class="container">

    <div class="content">
        <div class="wrap">
            <!-- Invisible SVG -->
            <svg viewBox="0 0 600 300" class="svg-defs">
                <!-- Symbol wth text -->
                <symbol id="s-text">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">
                        BABITA
                    </text>
                </symbol>

                <!-- Mask with text -->
                <mask id="m-text" maskunits="userSpaceOnUse" maskcontentunits="userSpaceOnUse">
                    <rect width="100%" height="100%" class="mask__shape">
                    </rect>
                    <use xlink:href="#s-text" class="text-mask"></use>
                </mask>
            </svg>

            <div class="box-with-text">
                <!-- Content for text -->
                <div class="text-fill">
                    <!-- Element with animated shadows -->
                    <div class="shadows"></div>
                </div>

                <!-- SVG to cover text fill -->
                <svg viewBox="0 0 600 300" class="svg-inverted-mask">
                    <!-- Big shape with hole in form of text -->
                    <rect width="100%" height="100%" mask="url(#m-text)" class="shape--fill" />
                    <!-- Transparent copy of text to keep patterned text selectable -->
                    <use xlink:href="#s-text" class="text--transparent"></use>
                </svg>
            </div>
        </div>
    </div>
    <!-- Related demos -->

</div>
<!-- /container -->



