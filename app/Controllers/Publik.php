<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-29
 * 
 * Publik Controller
 * 
 * Controller for handling public endpoints including autocomplete
 */

namespace App\Controllers;

use App\Models\ItemModel;

class Publik extends BaseController
{
    protected $itemModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    /**
     * Get items for autocomplete
     */
     public function getItemsStock()
     {
         try {
             $term = $this->request->getGet('term');
             
             // Build the query
             $builder = $this->db->table('tbl_m_item');
             $builder->select('
                 tbl_m_item.id,
                 tbl_m_item.kode,
                 tbl_m_item.item,
                 tbl_m_item.item_alias,
                 tbl_m_item.item_kand,
                 tbl_m_item.harga_beli,
                 tbl_m_item.harga_jual,
                 tbl_m_item.status
             ');
             $builder->where('tbl_m_item.status', '1');
             $builder->where('tbl_m_item.status_stok', '1');
             $builder->where('tbl_m_item.status_hps', '0');
             
             // Add search condition if term provided
             if (!empty($term)) {
                 $builder->groupStart()
                     ->like('item', $term)
                     ->orLike('item_kand', $term)
                     ->orLike('item_alias', $term)
                     ->orLike('kode', $term)
                     ->groupEnd();
             }
 
             $query = $builder->get();
             $results = $query->getResult();
 
             // Format the results
             $data = [];
             foreach ($results as $item) {
                 $data[] = [
                     'id'         => $item->id,
                     'kode'       => $item->kode,
                     'label'      => $item->item . ' (' . $item->kode . ')',
                     'item'       => $item->item,
                     'item_alias' => $item->item_alias,
                     'item_kand'  => $item->item_kand,
                     'harga_beli' => (float)$item->harga_beli,
                     'harga_jual' => (float)$item->harga_jual,
                     'status'     => (int)$item->status
                 ];
             }
 
             // Disable CSRF for this request
             if (isset($_COOKIE['csrf_cookie_name'])) {
                 unset($_COOKIE['csrf_cookie_name']);
                 setcookie('csrf_cookie_name', '', time() - 3600, '/');
             }
 
             // Send direct JSON response
             header('Content-Type: application/json; charset=utf-8');
             echo json_encode($data);
             exit();
         } catch (\Exception $e) {
             // Log the error
             log_message('error', '[Publik::getItems] Error: ' . $e->getMessage());
             
             // Send error response
             header('HTTP/1.1 500 Internal Server Error');
             header('Content-Type: application/json; charset=utf-8');
             echo json_encode([
                 'error' => true,
                 'message' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Internal server error'
             ]);
             exit();
         }
     }

    public function getItems()
    {
        try {
            $term = $this->request->getGet('term');
            
            // Build the query
            $builder = $this->db->table('tbl_m_item');
            $builder->select('
                tbl_m_item.id,
                tbl_m_item.kode,
                tbl_m_item.item,
                tbl_m_item.item_alias,
                tbl_m_item.item_kand,
                tbl_m_item.harga_beli,
                tbl_m_item.harga_jual,
                tbl_m_item.status
            ');
            $builder->where('tbl_m_item.status', '1');
            $builder->where('tbl_m_item.status_hps', '0');

            // Add search condition if term provided
            if (!empty($term)) {
                $builder->groupStart()
                    ->like('item', $term)
                    ->orLike('item_kand', $term)
                    ->orLike('item_alias', $term)
                    ->orLike('kode', $term)
                    ->groupEnd();
            }

            $query = $builder->get();
            $results = $query->getResult();

            // Format the results
            $data = [];
            foreach ($results as $item) {
                $data[] = [
                    'id'         => $item->id,
                    'kode'       => $item->kode,
                    'label'      => $item->item . ' (' . $item->kode . ')',
                    'item'       => $item->item,
                    'item_alias' => $item->item_alias,
                    'item_kand'  => $item->item_kand,
                    'harga_beli' => (float)$item->harga_beli,
                    'harga_jual' => (float)$item->harga_jual,
                    'status'     => (int)$item->status
                ];
            }

            // Disable CSRF for this request
            if (isset($_COOKIE['csrf_cookie_name'])) {
                unset($_COOKIE['csrf_cookie_name']);
                setcookie('csrf_cookie_name', '', time() - 3600, '/');
            }

            // Send direct JSON response
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
            exit();
        } catch (\Exception $e) {
            // Log the error
            log_message('error', '[Publik::getItems] Error: ' . $e->getMessage());
            
            // Send error response
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'error' => true,
                'message' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Internal server error'
            ]);
            exit();
        }
    }
} 