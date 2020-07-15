<div style="width: 500px; margin:0 auto;">
    <h3>상품 추가하기</h3>
    <!--파일 미리보기 스크립트 생성하기-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#fileToUpload").on('change', function(){
                //해당 url 실행
                readURL1(this);
            });

            $("#fileToUpload2").on('change', function(){
                readURL2(this);
            });

            $("#fileToUpload3").on('change', function(){
                readURL3(this);
            });
        });

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah3').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>



    <form action="upload_action3.php" method="post" enctype="multipart/form-data">


        <fieldset>
            <legend>Product</legend>
            <input type="text" name="itemname" placeholder="제품명">
            <br>
            <br>
            <textarea name="detail" cols="60" rows="8" placeholder="제품상세" style="resize: none"></textarea>
<!--            <input type="textarea" name="itemdetail" placeholder="제품상세정보">-->
        </fieldset>


        <fieldset>
            <legend>Select Image</legend>
        <input type="file" name="fileToUpload" id="fileToUpload">
            <img id="blah" src="./img/no-image-icon.PNG" alt="your image" style="width: 100px"/>
        <input type="file" name="fileToUpload2" id="fileToUpload2">
            <img id="blah2" src="./img/no-image-icon.PNG" alt="your image" style="width: 100px"/>
        <input type="file" name="fileToUpload3" id="fileToUpload3">
            <img id="blah3" src="./img/no-image-icon.PNG" alt="your image" style="width: 100px"/>
        </fieldset>

        <input type="hidden" name="price" value="1">
        <input type="hidden" name="quantity" value="1">
        <fieldset>
            <legend>Product</legend>
            <p>[Car]</p>

            Hyundai<input type="radio" name="itemid" value="11"/>
            Kia<input type="radio" name="itemid" value="12"/>
            Daewoo<input type="radio" name="itemid" value="13"/>
            Honda<input type="radio" name="itemid" value="14"/>
            <br>
            <br>
            SSangYoung<input type="radio" name="itemid" value="15" />
            Nissan<input type="radio" name="itemid" value="16" />
            Doyota<input type="radio" name="itemid" value="17" />
            Ford<input type="radio" name="itemid" value="18" />
            <br>
            <br>
            <p>[Parts]</p>
            Engine<input type="radio" name="itemid" value="21" />
            SpareParts<input type="radio" name="itemid" value="31" />

        </fieldset>
<!--        <fieldset>
            <legend>Another Parts</legend>
            Engine<input type="radio" name="itemdid" value="21" />
            <br>
            <br>
            SpareParts<input type="radio" name="itemdid" value="31" />
        </fieldset>-->


        <br>
        <div align="center">
            <input type="submit" value="상품 추가" name="submit">
        </div>

    </form>
</div>

