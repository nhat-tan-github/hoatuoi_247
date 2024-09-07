<?php
class Pagination {
    private $config = [
        'total' => 0,
        'limit' => 0,
        'full' => true,
        'querystring' => 'page'
    ];

    public function __construct($config = []) {
        $condition1 = isset($config['limit']) && $config['limit'] < 0;
        $condition2 = isset($config['total']) && $config['total'] < 0;

        if ($condition1 && $condition2) {
            die('limit và total không được nhỏ hơn 0');
        }

        if (!isset($config['querystring'])) {
            $config['querystring'] = 'page';
        }

        $this->config = $config;
    }

    private function getTotalPage() {
        $total = $this->config['total'];
        $limit = $this->config['limit'];
        return ceil($total / $limit);
    }

    private function getCurrentPage() {
        if (isset($_GET[$this->config['querystring']]) && (int)$_GET[$this->config['querystring']] >= 1) {
            $t = (int)$_GET[$this->config['querystring']];
            if ($t > $this->getTotalPage()) {
                return (int)$this->getTotalPage();
            } else {
                return $t;
            }
        } else {
            return 1;
        }
    }

    private function getPrePage() {
        if ($this->getCurrentPage() === 1) {
            return '<li class="item disabled"><span class="text">Previous</span></li>';
        } else {
            return '<li class="item"><a class="text" href="' .
                $_SERVER['PHP_SELF'] . '?' .
                $this->config['querystring'] . '=' .
                ($this->getCurrentPage() - 1) .
                '">Previous</a></li>';
        }
    }
    

    private function getNextPage() {
        if ($this->getCurrentPage() >= $this->getTotalPage()) {
            return;
        } else {
            return '<li class="item"><a class="text" href="' .
                $_SERVER['PHP_SELF'] . '?' .
                $this->config['querystring'] . '=' .
                ($this->getCurrentPage() + 1) .
                '">Next</a></li>';
        }
    }

    public function getPagination() {
        $data = '';
        if (isset($this->config['full']) && $this->config['full'] === false) {
            $data .= ($this->getCurrentPage() - 3) > 1 ? '<li class="item">...</li>' : '';
            $current = ($this->getCurrentPage() - 3) > 0 ? ($this->getCurrentPage() - 3) : 1;
            $total = (($this->getCurrentPage() + 3) > $this->getTotalPage() ?
                $this->getTotalPage() : ($this->getCurrentPage() + 3));

            for ($i = $current; $i <= $total; $i++) {
                if ($i === $this->getCurrentPage()) {
                    $data .= '<li class="item"><a href="#" class="text">' .
                        $i . '</a></li>';
                } else {
                    $data .= '<li class="item"><a class="text" href="' .
                        $_SERVER['PHP_SELF'] . '?' .
                        $this->config['querystring'] . '=' . $i .
                        '">' . $i . '</a></li>';
                }
            }
            $data .= ($this->getCurrentPage() + 3) < $this->getTotalPage() ?
                '<li class="item">...</li>' : '';
        } else {
            for ($i = 1; $i <= $this->getTotalPage(); $i++) {
                if ($i === $this->getCurrentPage()) {
                    $data .= '<li class="item"><a class="text" href="#">' .
                        $i . '</a></li>';
                } else {
                    $data .= '<li class="item"><a class="text" href="' .
                        $_SERVER['PHP_SELF'] . '?' .
                        $this->config['querystring'] . '=' .
                        $i . '">' . $i . '</a></li>';
                }
            }
        }
        // Trả về thanh chuyển trang được định dạng bằng ul
        return '<ul class="main-nav">' . $this->getPrePage() . $data . $this->getNextPage() . '</ul>';
    }
}
?>
