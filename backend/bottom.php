<div class="di"
    style="height:540px; border:#999 1px solid; width:76.5%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
    <!--正中央-->
    <?php include_once "logout.php";?>
    <div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
        <p class="t cent botli">頁尾版權資料管理</p>
        <form method="post" action="./api/update_data.php">
            <table width="50%" style="margin:auto">
                <tbody>
                    <tr class="yel">
                        <td width="50%">頁尾版權資料：</td>
                        <td width="50%"><input type="text" name="bottom" value="<?=$Bottom->find(1)['bottom'];?>"></td>
                    </tr>
                </tbody>
            </table>
            <table style="margin-top:40px; width:70%;">
                <tbody>
                    <tr>
                        <td width="200px">
                        <td class="cent">
                            <input type="hidden" name="table" value="<?=$do;?>">
                            <input type="submit" value="修改確定">
                            <input type="reset" value="重置">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>