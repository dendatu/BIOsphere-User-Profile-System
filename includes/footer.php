    </div>

    <script>

        const fileUpload = document.getElementById("fileUpload");

        if(fileUpload){

            fileUpload.addEventListener("change",function(){

                const file = this.files[0];

                if(file){

                    const reader = new FileReader();
                    reader.onload = function(e){
                        const preview = document.getElementById("preview");
                        preview.src = e.target.result;
                        preview.style.display="block";
                    };

                    reader.readAsDataURL(file);

                }

            });

        }

    </script>

</body>
</html>