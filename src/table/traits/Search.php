<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table\traits;

use surface\DataTypeInterface;
use surface\exception\SurfaceException;
use surface\form\Form;
use surface\Surface;

trait Search
{

    protected $searchFilter;

    /**
     * @var Form
     */
    protected $searchModel;

    /**
     * @param array|\Closure $search
     * @return self
     */
    public function search($search):self
    {
        $this->table('search', true);
        $this->searchFilter = $search;
        $this->searchModel = $this->buildSearch();
        return $this;
    }

    private function buildSearch()
    {
        if (!$searchFilter = $this->searchFilter) return null;
        $search = Surface::form(function (Form $form) use ($searchFilter){
            try {
                if ((is_array($searchFilter) && is_object($searchFilter[0])) || $searchFilter instanceof \Closure) {
                    $rules = call_user_func($searchFilter, $form);
                } else {
                    $rules = $searchFilter;
                }
                $search_rule = [];
                foreach ($rules as $v) {
                    if ($v instanceof DataTypeInterface) {
                        $search_rule[] = $v;
                    } elseif ($v[1] instanceof DataTypeInterface) {
                        $search_rule[] = $v[1];
                    } else {
                        array_shift($v); // 移除匹配规则
                        $rule = $v[4] ?? null;
                        $options = [];
                        if ($rule && isset($rule['options'])) {
                            $options = $rule['options'];
                            unset($rule['options']);
                        }
                        $formData = [
                            'type' => $v[0],
                            'field' => $v[1],
                            'title' => $v[2] ?? '',
                            'value' => $v[3] ?? '',
                            'rule'  => $rule,
                        ];
                        if ($options) {
                            $formData['options'] = $options;
                        }
                        $search_rule[] = $form->createFormItem($formData, $form, false);
                    }
                }
                $form->rule($search_rule);

                $form->setResetBtn([
                    'type' => 'default',
                    'icon' => 'el-icon-close',
                    'col' => [
                        'xl' => [
                            'span' => 1
                        ],
                        'lg' => [
                            'span' => 1
                        ],
                        'md' => [
                            'span' => 2
                        ],
                        'sm' => [
                            'span' => 3
                        ],
                        'xs' => [
                            'span' => 8
                        ]
                    ]
                ]);

                $form->setSubmitBtn([
                    'icon' => 'el-icon-search',
                    'col' => [
                        'xl' => [
                            'span' => 2,
                            'offset' => 21
                        ],
                        'lg' => [
                            'span' => 2,
                            'offset' => 21
                        ],
                        'md' => [
                            'span' => 3,
                            'offset' => 19
                        ],
                        'sm' => [
                            'span' => 5,
                            'offset' => 16
                        ],
                        'xs' => [
                            'span' => 16
                        ]
                    ]
                ]);

                $form->globals('*', [
                    'col' => [
                        'xl' => [
                            'span' => 4,
                        ],
                        'lg' => [
                            'span' => 6,
                        ],
                        'md' => [
                            'span' => 8,
                        ],
                        'sm' => [
                            'span' => 12,
                        ]
                    ]
                ]);
            }catch (\Exception $e) {
                throw new SurfaceException($e->getMessage());
            }
        });

        $this->addScript($search->getScript());
        $this->addStyle($search->getStyle());

        return $search;
    }

    public function getSearch()
    {
        return $this->searchModel;
    }

    public function getSearchParam($name = '')
    {
        if (!$this->searchModel) return '';

        switch ($name) {
            case 'constitute':
                return $this->searchModel->getConstitute();
                break;
            case 'rule':
                return $this->searchModel->rule();
                break;
            case 'globals':
                return $this->searchModel->globals();
                break;
            case '':
                return [
                    'constitute' => $this->getSearchParam('constitute'),
                    'rule' => $this->getSearchParam('rule'),
                    'globals' => $this->getSearchParam('globals'),
                ];
                break;
            default:
                return '';
        }
    }

}