</div>
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    imageviewer.src = URL.createObjectURL(file)
                }
            }
        </script>
    </body>
</html>