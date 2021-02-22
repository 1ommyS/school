import React, {useEffect, useState} from 'react';
import {NavLink} from "react-router-dom";
import axios from "axios";
import {Button, Input, InputNumber, Layout, Menu, Modal, Space, Spin} from 'antd';
import {
     DollarOutlined,
    ExclamationCircleOutlined,
    AreaChartOutlined,     SearchOutlined,
    UserOutlined,
} from '@ant-design/icons';
import Sider from "antd/lib/layout/Sider";
import {Content} from "antd/lib/layout/layout";
import {TableContainer} from "../Table/table.container";
import {Breakpoint} from "antd/es/_util/responsiveObserve";


const {confirm} = Modal;

interface IResponse {
    date: string,
    id: number,
    price: number,
    comment: string
}

const Payments = () => {
    let [activeId, updateId] = useState(5);

    const [payments, setPayments]: [IResponse[], any] = useState([]);
    const [isLoading, setLoading] = useState(true);
    const [collapsed, setCollapsed] = useState(true);
    const onCollapse = () => {
        setCollapsed(!collapsed);
    };
    const [state, setState] = useState({
        searchText: '',
        searchedColumn: '',
    });
    let searchInput;
    const handleSearch = (selectedKeys, confirm, dataIndex) => {
        confirm();
        setState({
            searchText: selectedKeys[0],
            searchedColumn: dataIndex,
        });
    };


    const [modalState, sModalState] = useState({
        loading: false,
        visible: false
    });
    const showModal = key => {
        updateId(key);
        sModalState({
            loading: false,
            visible: true
        });
    };

    const handleOk = () => {
        // @ts-ignore
        sModalState({loading: true});
        setTimeout(() => {
            this.setState({loading: false, visible: false});
        }, 3000);
    };
    const handleCancel = () => {
        // @ts-ignore
        sModalState({visible: false});
    };

    const handleReset = clearFilters => {
        clearFilters();
        // @ts-ignore
        setState({searchText: ''});
    };

    async function getPayments() {
        let result = await axios.get("/api/v1/payments");
        setPayments(result.data);
        setLoading(false);
    }

    const getColumnSearchProps = dataIndex => ({
        filterDropdown: ({setSelectedKeys, selectedKeys, confirm, clearFilters}) => (
            <div style={{padding: 8}}>
                <Input
                    ref={node => {
                        searchInput = node;
                    }}
                    placeholder={`Введите имя учителя`}
                    value={selectedKeys[0]}
                    onChange={e => setSelectedKeys(e.target.value ? [e.target.value] : [])}
                    onPressEnter={() => handleSearch(selectedKeys, confirm, dataIndex)}
                    style={{width: 188, marginBottom: 8, display: 'block'}}
                />
                <Space>
                    <Button
                        onClick={() => handleSearch(selectedKeys, confirm, dataIndex)}
                        icon={<SearchOutlined />}
                        size="small"
                        style={{width: 90, background: "linear-gradient(to bottom, #FFA632, #E8880B)", color: "white"}}
                    >
                        Поиск
                    </Button>
                    <Button onClick={() => handleReset(clearFilters)} size="small" style={{width: 90}}>
                        Сбросить
                    </Button>
                    <Button
                        type="link"
                        size="small"
                        onClick={() => {
                            confirm({closeDropdown: false});
                            setState({
                                searchText: selectedKeys[0],
                                searchedColumn: dataIndex,
                            });
                        }}
                    >
                        Отфильтровать
                    </Button>
                </Space>
            </div>
        ),
        filterIcon: filtered => <SearchOutlined style={{color: filtered ? '#FFA632' : undefined}} />,
        onFilter: (value, record) =>
            record[dataIndex]
                ? record[dataIndex].toString().toLowerCase().includes(value.toLowerCase())
                : '',
        onFilterDropdownVisibleChange: visible => {
            if (visible) {
                setTimeout(() => searchInput.select(), 100);
            }
        },
    });

    useEffect(() => {
        getPayments();
    }, []);

    const showDeleteConfirm = key => {
        confirm({
            title: 'Вы точно хотите удалить эту запись?',
            icon: <ExclamationCircleOutlined />,
            okText: 'Да',
            okType: 'danger',
            cancelText: 'Нет',
            onOk() {
                axios.delete(`/api/v1/payments/${key}`);
                getPayments();
            },
            onCancel() {
                console.log('Cancel');
            },
        });
    };

    const columns = [
        {
            title: 'Назначение',
            dataIndex: 'comment',
            key: `comment${Math.random()}`,
            ...getColumnSearchProps('comment'),
            responsive: ['md'] as Breakpoint[]
        },
        {
            title: 'Сумма',
            dataIndex: 'price',
            key: `price${Math.random()}`,
            responsive: ['md'] as Breakpoint[]
        },
        {
            title: 'Дата платежа',
            dataIndex: 'date',
            key: `date${Math.random()}__${Math.random()}__${Math.random()}`,
            sorter: (a, b) => Date.parse(a.date) - Date.parse(b.date),
            sortDirections: ['descend', 'ascend'],
            responsive: ['md'] as Breakpoint[]
        },
        {
            title: 'Действия',
            key: `actions${Math.random()}:${Math.random()}`,
            render: (text, record) => (
                <Space size="small">
                    <Button type="primary" onClick={() => showDeleteConfirm(record.key)} danger>Удалить</Button>
                    <Button type="primary" style={{
                        background: "linear-gradient(to bottom, #FFA632, #E8880B)",
                        border: "1px solid orange"
                    }} onClick={() => showModal(record.key)}>Поменять значение</Button>
                </Space>
            ),
        },
    ];

    const saveNewValue = async (value: number | string) => {
        await axios.post(`/api/v1/payments/${activeId}`,
            JSON.stringify({
                value
            })
        );
        await getPayments();
    };

    return (
        <Layout style={{minHeight: '100vh', textAlign: "center"}}>
            <Sider collapsible collapsed={collapsed} onCollapse={onCollapse}>
                <div className="logo" />
                <Menu theme="dark" defaultSelectedKeys={["3"]} mode="inline">
                    <Menu.Item key="1" icon={<UserOutlined />}>
                        <NavLink to="/panel"> Ученики</NavLink>
                    </Menu.Item>
                    <Menu.Item key="2" icon={<DollarOutlined />}>
                        <NavLink to="/panel/premiums">Премии</NavLink>
                    </Menu.Item>
                    <Menu.Item key="3" icon={<AreaChartOutlined />}>
                        <NavLink to="/panel/payments">Платежи</NavLink>
                    </Menu.Item>
                </Menu>
            </Sider>
            <Layout className="site-layout">

                <Content style={{margin: '0 16px'}}>
                    <div style={{margin: "20px"}}>
                        <Button style={{background:"linear-gradient(to bottom, #FFA632, #E8880B)", border: "1px solid orange"}}>
                            <a href="/profile">В личный кабинет</a>
                        </Button>
                    </div>
                    {isLoading ? <Spin size={"large"} /> : <div>
                        <Modal
                        visible={modalState.visible}
                        title="Обновить значение"
                        onOk={handleOk}
                        centered
                        onCancel={handleCancel}
                        footer={[
                            <Button key="back" onClick={handleCancel}>
                                Отменить
                            </Button>,
                            <Button key="submit" type="primary" loading={modalState.loading} onClick={handleOk}>
                                Обновить
                            </Button>,
                        ]}
                    >
                        <InputNumber
                            style={{width: "400px"}}
                            defaultValue={payments.find(el => el.id === activeId).price}
                            onChange={(value) => saveNewValue(value)}
                        />
                    </Modal>
                        <TableContainer columns={columns}  data={payments} />
                    </div>
                    }
                </Content>
            </Layout>
        </Layout>
    );
};

export default Payments;
