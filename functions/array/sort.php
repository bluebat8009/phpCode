<?php
/**
 * 多维数组的多个字段排序
 * @return mixed|null 多维数组的多字段排序
 * @throws Exception
 */
function array_sort_by_many_field()
{
    //获取函数传递的参数，第一个参数必须是一个数组
    $args = func_get_args();
    if (empty($args)) {
        return null;
    }
    $arr = array_shift($args);
    if (!is_array($arr)) {
        throw new Exception("第一个参数必须要是一个数组");
    }
    foreach ($args as $key => $field) {
        if (is_string($field)) {
            $temp = array();
            foreach ($arr as $index => $val) {
                $temp[$index] = $val[$field];
            }
            $args[$key] = $temp;
        }
    }
    $args[] = &$arr;//引用值
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

/**
 * demo
$demo_array = array(
array('id' => 8, 'name' => 'Bob', 'age' => 18, 'score' => 92),
array('id' => 9, 'name' => 'Sun', 'age' => 16, 'score' => 99),
array('id' => 3, 'name' => 'Snow', 'age' => 16, 'score' => 82),
array('id' => 11, 'name' => 'Frank', 'age' => 22, 'score' => 90),
array('id' => 11, 'name' => 'Frank', 'age' => 18, 'score' => 90),
array('id' => 11, 'name' => 'Frank', 'age' => 29, 'score' => 90),
);
$arr = array_sort_by_many_field($demo_array, 'score', SORT_DESC, 'age', SORT_ASC);
print_r($arr);
 */
