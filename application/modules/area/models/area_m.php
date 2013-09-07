<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/14/13
 * Time: 7:23 PM
 * To change this template use File | Settings | File Templates.
 */

class Area_m extends MY_Model
{

    protected $_table = 'areas';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return parent::get_all();
    }

    public function get_table()
    {
        $areas = $this->get_all();
        $str = "";
        foreach ($areas as $item) {
            $str .= "<tr>";
            $str .= "<td> " . $item->Name . " </td>";
            $str .= "<td> " . $this->get_name_by_id($item->ParentId) . " </td>";
            $str .= "<td><a class=\"btn btn-primary btn-mini\"
                                       href=\"" . base_url() . "area/edit?Id=" . $item->Id . "\">edit</a></td>";
            $str .= "<td><a class=\"btn btn-danger btn-mini\"
                                       href=\"#\" id=\"" . $item->Id . "\" onclick=\"return Delete(this)\">delete</a></td>";
            $str .= "</tr>";
        }
        return $str;
    }

    public function insert($data)
    {
        return parent::insert($data, FALSE);
    }

    public function get_name_by_id($area_id)
    {
        if ($area_id != 0) {
            $a = $this->get_by($area_id);
            return $a->Name;
        } else {
            return "Root area";
        }
    }

    function update_by($id, $data)
    {
        return parent::update($id, $data, FALSE);
    }

    function get_by($id)
    {
        return parent::get($id);
    }

    public function getTree($parentId = 0)
    {
        $trees = array();
        parent::where('ParentId', $parentId);
        $query = parent::get_all();
        foreach ($query as $item) {
            $trees[] = array('Id' => $item->Id, 'Name' => $item->Name);
        }
        return $trees;
    }

    public function LoadTree()
    {
        $Menu = $this->getTree(0);
        $str = '<ul id="navigation">';
        foreach ($Menu as $k => $rs) {
            $str .= '<li>';
            $href = base_url() . "area/edit?Id=" . $rs['Id'];
            $str .= ' <a href="' . $href . '">' . $rs['Name'] . '</a>';
            $sub = $this->getTree($rs['Id']);
            if (count($sub) > 0) {
                $str .= $this->LoadTreeSub($rs['Id']);
            }

            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

    public function LoadTreeSub($parentId)
    {
        $Menu = $this->getTree($parentId);
        $str = '<ul>';
        foreach ($Menu as $k => $rs) {
            $str .= '<li>';
            $href = base_url() . "area/edit?Id=" . $rs['Id'];
            $str .= ' <a href="' . $href . '">' . $rs['Name'] . '</a>';
            $sub = $this->getTree($rs['Id']);
            if (count($sub) > 0) {
                $str .= $this->LoadTreeSub($rs['Id']);
            }

            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

    public function LoadOption($root = false, $id = 0)
    {
        $Menu = $this->getTree(0);
        $str = '<select name="cbArea" style="width: 300px;">';
        if ($root) {
            $str .= '<option value="0">Root area</option>';
        }
        foreach ($Menu as $k => $rs) {

            $s = ($id != 0 && $id == $rs['Id']) ? "selected" : "";
            $str .= '<option value="' . $rs['Id'] . '" ' . $s . '>' . $rs['Name'] . '</option>';
            $sub = $this->getTree($rs['Id']);
            if (count($sub) > 0) {
                $str .= $this->LoadOptionSub($rs['Id'], '__', $id);
            }
        }
        $str .= '</select>';
        return $str;
    }

    public function LoadOptionChoose($choose = false, $id = 0)
    {
        $Menu = $this->getTree(0);
        $str = '<select name="cbArea" style="width: 300px;" id="cbArea" onchange="check_station_by_area_id(this)">';
        if ($choose) {
            $str .= '<option value="0">Choose area</option>';
        }
        foreach ($Menu as $k => $rs) {

            $s = ($id != 0 && $id == $rs['Id']) ? "selected" : "";
            $str .= '<option value="' . $rs['Id'] . '" ' . $s . '>' . $rs['Name'] . '</option>';
            $sub = $this->getTree($rs['Id']);
            if (count($sub) > 0) {
                $str .= $this->LoadOptionSub($rs['Id'], '__', $id);
            }
        }
        $str .= '</select>';
        return $str;
    }

    public function LoadOptionSub($parentId, $space, $id = 0)
    {
        $Menu = $this->getTree($parentId);
        $str = '';
        foreach ($Menu as $k => $rs) {
            $s = ($id != 0 && $id == $rs['Id']) ? "selected" : "";
            $str .= '<option value="' . $rs['Id'] . '" ' . $s . '>' . $space . $rs['Name'] . '</option>';
            $sub = $this->getTree($rs['Id']);
            if (count($sub) > 0) {
                $str .= $this->LoadOptionSub($rs['Id'], $space . '__', $id);
            }
        }
        return $str;
    }

    public function get_a_s_temp_by_area_id($area_id)
    {
        $this->_table = "a_s_temp";
        parent::select("a_s_temp.AreaId, a_s_temp.StationId, stations.Name as StationName");
        parent::where("a_s_temp.AreaId", $area_id);
        parent::join("stations", "stations.Id = a_s_temp.StationId");
        return parent::get_all();
    }

    public function addastemp($data)
    {
        $this->_table = 'a_s_temp';
        return $this->insert($data);
    }

    public function removeastemp($data)
    {
        $this->_table = 'a_s_temp';
        return $this->db->delete($this->_table, $data);
    }

    public function delete_by($data)
    {
        return $this->db->delete($this->_table, $data);
    }
}