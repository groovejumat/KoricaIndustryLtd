<div style="width: 500px; margin:0 auto;">

    <h3>상품 수정하기</h3>

<!--    --><?php //echo "가지고온 값 확인 : ".  $_POST['hidden_id'] ?>
<!--    --><?php //echo $_POST['hidden_id'] ?>
    <?php
    $connect = mysqli_connect("localhost", "root", "password", "WEBService") or die("fail");

    //아이디가 있는지 검사(로그인)
    $id=$_POST['hidden_id'];
    $query = "select * from product where id='$id'";
    $result = $connect->query($query);
    $row=mysqli_fetch_assoc($result);

    ?>

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

    <form action="itemrewrite_action.php" method="post" enctype="multipart/form-data">

        <fieldset>
            <legend>Product</legend>
            <input type="text" name="itemname" placeholder="제품명" value="<?php echo $row['productname'];?>">
            <br>
            <br>
            <textarea name="detail" cols="60" rows="8" placeholder="제품상세" style="resize: none"><?php echo $row['detail'];?></textarea>
        </fieldset>


        <fieldset>
            <legend>Select Image</legend>
            <input type="hidden" name="hidden_id" value="<?php echo $id?>"> <!--변경할 아이디의 고유 아이디 값 보내기-->
            <input type="file" name="fileToUpload" id="fileToUpload">
            <img id="blah" src="<?php echo $row['imgurl'];?>" alt="your image" style="width: 100px"/>
            <input type="file" name="fileToUpload2" id="fileToUpload2">
            <?php if($row['subimgurl1']==NULL){
                ?>
                <img id="blah2" src="./img/no-image-icon.PNG" alt="your image" style="width: 100px"/>
                <?php
            }
            else{
                ?>
                <img id="blah2" src="<?php echo $row['subimgurl1'];?>" alt="your image" style="width: 100px"/>
                <?php
            }?>
<!--            <img id="blah2" src="<?php /*echo $row['subimgurl1'];*/?>" alt="your image" style="width: 100px"/>-->
            <input type="file" name="fileToUpload3" id="fileToUpload3">
            <?php if($row['subimgurl2']==NULL){
                ?>
                <img id="blah3" src="./img/no-image-icon.PNG" alt="your image" style="width: 100px"/>
                <?php
            }
            else{
                ?>
                <img id="blah3" src="<?php echo $row['subimgurl2'];?>" alt="your image" style="width: 100px"/>
                <?php
            }?>
<!--            <img id="blah3" src="<?php /*echo $row['subimgurl2'];*/?>" alt="your image" style="width: 100px"/>-->
        </fieldset>

        <input type="hidden" name="price" value="1">
        <input type="hidden" name="quantity" value="1">
<!--        <p>품목 선택하기</p>-->
        <fieldset>
            <legend>Product</legend>
            <p>[Car]</p>

            <?php
            if($row['itemid']==11){?>
                Hyundai<input type="radio" name="itemid" value="11" checked="checked"/>
            <?php
            }else{
                ?>
                Hyundai<input type="radio" name="itemid" value="11"/>
            <?php
            }
            ?>

            <?php
            if($row['itemid']==12){?>
                Kia<input type="radio" name="itemid" value="12" checked="checked"/>
                <?php
            }else{
                ?>
                Kia<input type="radio" name="itemid" value="12"/>
                <?php
            }
            ?>

            <?php
            if($row['itemid']==13){?>
                Daewoo<input type="radio" name="itemid" value="13" checked="checked"/>
                <?php
            }else{
                ?>
                Daewoo<input type="radio" name="itemid" value="13"/>
                <?php
            }
            ?>

            <?php
            if($row['itemid']==14){?>
                Honda<input type="radio" name="itemid" value="14" checked="checked"/>
                <?php
            }else{
                ?>
                Honda<input type="radio" name="itemid" value="14"/>
                <?php
            }
            ?>

            <br>
            <br>

            <?php
            if($row['itemid']==15){?>
                SSangYoung<input type="radio" name="itemid" value="15" checked="checked" />
                <?php
            }else{
                ?>
                SSangYoung<input type="radio" name="itemid" value="15" />
                <?php
            }
            ?>

            <?php
            if($row['itemid']==16){?>
                Nissan<input type="radio" name="itemid" value="16" checked="checked" />
                <?php
            }else{
                ?>
                Nissan<input type="radio" name="itemid" value="16" />
                <?php
            }
            ?>

            <?php
            if($row['itemid']==17){?>
                Doyota<input type="radio" name="itemid" value="17" checked="checked"/>
                <?php
            }else{
                ?>
                Doyota<input type="radio" name="itemid" value="17" />
                <?php
            }
            ?>

            <?php
            if($row['itemid']==18){?>
                Ford<input type="radio" name="itemid" value="18" checked="checked"/>
                <?php
            }else{
                ?>
                Ford<input type="radio" name="itemid" value="18" />
                <?php
            }
            ?>
            <br>
            <br>
            <p>[Parts]</p>

            <?php
            if($row['itemid']==21){?>
                Engine<input type="radio" name="itemid" value="21" checked="checked"/>
                <?php
            }else{
                ?>
                Engine<input type="radio" name="itemid" value="21" />
                <?php
            }
            ?>


            <?php
            if($row['itemid']==31){?>
                SpareParts<input type="radio" name="itemid" value="31" checked="checked"/>
                <?php
            }else{
                ?>
                SpareParts<input type="radio" name="itemid" value="31" />
                <?php
            }
            ?>


<!--            Hyundai<input type="radio" name="itemid" value="11"/>
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
            SpareParts<input type="radio" name="itemid" value="31" />-->

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
            <input type="submit" value="정보 수정하기" name="submit">
        </div>

    </form>
</div>

