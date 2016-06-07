<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Housing Score</title>
    <script src="js/jquery.js"></script> 
    <style>
        #template{display:none;}
        table{
            
        }
        th,td{
            padding:10px;
            border:1px solid #888;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="welcome">
        <h1>Score our houses</h1>
        <table>
            <thead>
                <tr>
                    <th>名称</th>
                    <th>距离*2</th>
                    <th>楼层*1.5</th>
                    <th>新旧*0.5</th>
                    <th>户型*2</th>
                    <th>学区*1.5</th>
                    <th>通风*1.5</th>
                     <th>采光*1</th>
                    <th>总分</th>
                    </tr>
            </thead>
            <tbody>
                 <tr data-id="" id="template">
                    <td contenteditable='true'></td>
                    <td class='value' contenteditable='true'></td>
                     <td class='value'  contenteditable='true'></td>
                      <td class='value'  contenteditable='true'></td>
                       <td  class='value' contenteditable='true'></td>
                        <td  class='value' contenteditable='true'></td>
                         <td  class='value' contenteditable='true'></td>
                          <td class='value'  contenteditable='true'></td>
                          <td class='total'>
                              
                          </td>
                </tr>
                <?php if(!empty($items)):
                    foreach($items as $item):
                        ?>
                <tr data-id="<?=$item->id ?>">
                    <td contenteditable='true'><?=$item->name ?></td>
                    <td class='value' contenteditable='true'><?=$item->distance ?></td>
                     <td class='value'  contenteditable='true'><?=$item->floor ?></td>
                      <td class='value'  contenteditable='true'><?=$item->age ?></td>
                       <td  class='value' contenteditable='true'><?=$item->layout ?></td>
                        <td  class='value' contenteditable='true'><?=$item->school ?></td>
                         <td  class='value' contenteditable='true'><?=$item->air ?></td>
                          <td class='value'  contenteditable='true'><?=$item->light ?></td>
                          <td class='total'>
                              <?=$item->name*2 +  $item->distance*1.5 + $item->age*0.5 + $item->layout*2 + $item->school*1.5 + $item->air*1.5 + $item->light*1?>
                          </td>
                </tr>
                <?php  endforeach;
              endif;?>
           </tbody>
        </table>
        <button id="add" type="btn" style="margin-top:30px;">Add</button>
    </div>
    <script>
        function updateTotal($tr){
            var total = $tr.find('td:nth-child(2)').html()*2
            +  $tr.find('td:nth-child(3)').html()*1.5
     +  $tr.find('td:nth-child(4)').html()*0.5
      +  $tr.find('td:nth-child(5)').html()*2
       +  $tr.find('td:nth-child(6)').html()*1.5
        +  $tr.find('td:nth-child(7)').html()*1.5
        +  $tr.find('td:nth-child(8)').html()*1
            $tr.find('td.total').html(total);
            $.ajax({
                url: "index.php/home/ajax",
                type:'get',
                dataType: 'json',
                data:{
                    id: $tr.data('id'),
                     name:$tr.find('td:nth-child(1)').html(),
                    distance:$tr.find('td:nth-child(2)').html(),
                    floor:$tr.find('td:nth-child(3)').html(),
                    age:$tr.find('td:nth-child(4)').html(),
                    layout:$tr.find('td:nth-child(5)').html(),
                    school:$tr.find('td:nth-child(6)').html(),
                    air:$tr.find('td:nth-child(7)').html(),
                    light:$tr.find('td:nth-child(8)').html(),
                    
                }
              
              }).done(function(data) {
               if(data['id']){
                   var id = data['id'];
                   $tr.data('id',id);
               }
              });
        }
    $(document).ready(
            function(){
                $('tbody td.value').blur(function(){
                    var value = 0;
                    if($.isNumeric($(this).html())){
                         value = parseInt($(this).html());
                    }
                 
                   $(this).html(value);
                   updateTotal($(this).parent('tr'));
                });
                $('#add').click(function(){
                   var $new =  $('#template').clone(true,true);
                   $new.removeAttr('id').appendTo('tbody').show();
                });
            });
     </script>
</body>
</html>