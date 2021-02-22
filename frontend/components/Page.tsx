import "./style.css";
import axios from "axios";
import React, {useEffect, useState} from "react";
import {Button, Input, Layout, Menu, Modal, Space, Spin, Tag} from "antd";
import {
    AreaChartOutlined,
    DollarOutlined,
    ExclamationCircleOutlined,
    SearchOutlined,
    UserOutlined
} from "@ant-design/icons";
import {TableContainer} from "./Table/table.container";
import {NavLink} from "react-router-dom";
import {Breakpoint} from "antd/lib/_util/responsiveObserve";

const {confirm} = Modal;

const {Sider} = Layout;
const {Header, Content} = Layout;


export const Page = () => {
    const [collapsed, setCollapsed] = useState(true);
    // @ts-ignore
    const [students, setStudents] = useState({}) as any[];
    const [isLoading, setLoading] = useState(true);

    const [state, setState] = useState({
        searchText: '',
        searchedColumn: '',
    });
    let searchInput;
    const getDataFromServer = async () => {
        let result = await axios.get("/api/v1/students");
        setStudents(result.data);
        setLoading(false);
    };
    const getColumnSearchProps = dataIndex => ({
        filterDropdown: ({setSelectedKeys, selectedKeys, confirm, clearFilters}) => (
            <div style={{padding: 8}}>
                <Input
                    ref={node => {
                        searchInput = node;
                    }}
                    placeholder={`Search ${dataIndex}`}
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

    const showDeleteConfirm = (id) => {
        confirm({
            title: 'Вы точно хотите удалить этого пользователя?',
            icon: <ExclamationCircleOutlined />,
            okText: 'Да',
            okType: 'danger',
            cancelText: 'Нет',
            onOk() {
                axios.delete(`/api/v1/student/${id}`)
                getDataFromServer();
            },
            onCancel() {
                console.log('Cancel');
            },
        });
    }

    const onCollapse = () => {
        setCollapsed(!collapsed);
    };
    const handleSearch = (selectedKeys, confirm, dataIndex) => {
        confirm();
        setState({
            searchText: selectedKeys[0],
            searchedColumn: dataIndex,
        });
    };
    const handleReset = clearFilters => {
        clearFilters();
        // @ts-ignore
        setState({searchText: ''});
    };

    // @ts-ignore
    useEffect(() => {
        getDataFromServer();
    }, [students])

    const columns = [
        {
            title: 'Имя',
            dataIndex: 'name',
            key: `name${Math.random()}`,
            ...getColumnSearchProps('name'),
        },
        {
            title: 'Логин',
            dataIndex: 'login',
            key: `login${Math.random()}`,
            responsive: ['md'] as Breakpoint[]
        },
        {
            title: 'ВК',
            dataIndex: 'link_vk',
            key: `link_vk${Math.random()}`,
            responsive: ['md'] as Breakpoint[]
        }, {
            title: 'Количество групп',
            dataIndex: 'group_amount',
            key: `group_amount${Math.random()}`,
            responsive: ['md'] as Breakpoint[]
        }, {
            title: 'Статусы',
            dataIndex: 'tags',
            key: 'tags',
            responsive: ['md'] as Breakpoint[],
            render: tags => (
                <>
                    {tags.map(tag => {
                        let color;
                        if (tag === "льготник")
                            color = "geekblue";
                        else if (tag === "выпустившийся") color = "green";
                        else if (tag === "нет статусов") color = "red";

                        return (
                            <Tag color={color} key={tag}>
                                {tag.toUpperCase()}
                            </Tag>
                        );
                    })}
                </>
            )
        },
        {
            title: 'Действия',
            key: `action${Math.random()}`,
            render: (text, record) => (
                <Space size="small">
                    <NavLink to={{
                        pathname: `/panel/edit/${record.key}`
                    }}>Действия</NavLink>
                    <Button onClick={() => showDeleteConfirm(record.key)} type="primary" danger block>
                        Удалить
                    </Button>
                </Space>
            ),
        },
    ];

    return (
        <Layout style={{minHeight: '100vh'}}>
            {isLoading ? <Spin size={"large"} /> : (
                <>
                    <Sider collapsible collapsed={collapsed} onCollapse={onCollapse}>
                        <div className="logo" />
                        <Menu theme="dark" defaultSelectedKeys={["1"]} mode="inline">
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
                        <Header className="site-layout-background" style={{padding: 0}} />
                        <Content style={{margin: '0 16px'}}>
                            <div style={{margin: "20px"}}>
                                <Button style={{
                                    background: "linear-gradient(to bottom, #FFA632, #E8880B)",
                                    border: "1px solid orange"
                                }}>
                                    <a href="/profile">В личный кабинет</a>
                                </Button>
                            </div>
                            <TableContainer columns={columns} data={students} />
                        </Content>
                    </Layout>
                </>
            )}

        </Layout>
    );
}
