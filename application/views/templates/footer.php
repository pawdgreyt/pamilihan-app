</div>
        <script>
            // CKEDITOR.replace('editor1');
            const liElement = document.querySelector('.nav-item.dropdown');
            const toggle = document.getElementById('CollapseNavBarToggle');
            const navbar = document.getElementById('CollapseNavBar');

            liElement.addEventListener('click', function () {
                // Toggle the "open" class on the <li> element
                if (liElement.classList.contains('open')) {
                    liElement.classList.remove('open');
                } else {
                    liElement.classList.add('open');
                }
            });

            toggle.addEventListener('click', function () {
                // Toggle the "open" class on the <li> element
                if (navbar.classList.contains('in')) {
                    navbar.classList.remove('in');
                } else {
                    navbar.classList.add('in');
                }
            });

            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    imageviewer.src = URL.createObjectURL(file)
                }
            }
        </script>
    </body>
</html>