import React, {useEffect, useState} from 'react';
import {NavLink, useParams} from "react-router-dom";
import axios from "axios";
import {Button, Collapse, InputNumber, Layout, Menu, Modal, Select} from 'antd';
import {AreaChartOutlined, ExclamationCircleOutlined, DollarOutlined, UserOutlined,} from '@ant-design/icons';
import Title from "antd/lib/typography/Title";
import {Spinner} from "../Spinner/Spinner";

const {Option} = Select;
const {Panel} = Collapse;

const {confirm} = Modal;

const Edit = () => {

    const {id} = useParams();
    const [isLoading, setLoading] = useState(true);
    const [groups, setGroups] = useState([]);
    const [collapsed, setCollapsed] = useState(true);
    const {Sider} = Layout;
    const [money, setMoney] = useState(0);
    const [bonuses, setBonuses] = useState(0);
    const {Header, Content} = Layout;
    const [selected, setSelected] = useState(0);

    const getGroups = async () => {
        let result = await axios.get(`/api/v1/${id}/groups`);
        setGroups(result.data);
        setLoading(false);
    }
    async function onChange(value) {
        setSelected(value);
        let result = await axios.get(`/api/v1/groups/${value}/${id}`);
        setMoney(result.data.balance);
        setBonuses(result.data.count_bonus_lessons);
        setLoading(false);
    }
    const onCollapse = () => {
        setCollapsed(!collapsed);
    };

    function onBlur() {
    }

    function onFocus() {
    }

    function onSearch(val) {
    }

    // @ts-ignore
    useEffect(() => {
        getGroups();
    }, [])
    const showDeleteConfirm = () => {
        confirm({
            title: 'Вы точно хотите удалить этого пользователя?',
            icon: <ExclamationCircleOutlined />,
            okText: 'Да',
            okType: 'danger',
            cancelText: 'Нет',
            onOk() {
                axios.post(`/api/v1/${selected}/${id}/update`, JSON.stringify({
                    type: "KICK",
                    student_id: id,
                    group_id: selected
                }))
                window.location.reload();
            },
            onCancel() {
                console.log('Cancel');
            },
        });
    }

    const updateStudentBalance = async (value: number | string) => {
        await axios.post(`/api/v1/${selected}/${id}/update`, JSON.stringify({
            type: "MONEY",
            value,
            student_id: id,
            group_id: selected
        }));
    }
    const updateStudentBonuses = async (value: number | string) => {
        await axios.post(`/api/v1/${selected}/${id}/update`, JSON.stringify({
            type: "BONUSES",
            value,
            student_id: id,
            group_id: selected
        }));
    }

    return (
        <Layout style={{minHeight: '100vh', textAlign: "center"}}>
            <Sider collapsible collapsed={collapsed} onCollapse={onCollapse}>
                <div className="logo" />
                <Menu theme="dark" defaultSelectedKeys={["1"]} mode="inline">
                    <Menu.Item key="1" icon={<UserOutlined />}>
                        Ученики
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
                        <NavLink to="/panel">Назад</NavLink>
                    </Button>
                    </div>
                    <div>
                        <Title level={1} copyable={false} style={{fontSize: "48px"}}> Выберите группу и действие</Title>
                    </div>
                    <div>
                        <Select
                            showSearch
                            style={{width: 1050, margin: "10px"}}
                            placeholder="Выберите группу"
                            optionFilterProp="children"
                            onChange={onChange}
                            onFocus={onFocus}
                            onBlur={onBlur}
                            onSearch={onSearch}
                            filterOption={(input, option) =>
                                option.children.toLowerCase().indexOf(input.toLowerCase()) >= 0
                            }
                        >
                            {
                                groups.map((group) => (
                                    <Option id={group.id}
                                            key={group.id * group.id * group.id}
                                            value={group.id}>{group.name_group}</Option>)
                                )
                            }
                        </Select>
                        <Collapse>
                            <Panel header="Изменение баланса" key={Math.random()}>
                                <InputNumber defaultValue={money} onChange={(value) => updateStudentBalance(value)} />
                            </Panel>
                            <Panel header="Изменение количества бонусных занятий" key={Math.random()}>
                                <InputNumber min={0} defaultValue={bonuses}
                                             onChange={(value) => updateStudentBonuses(value)} />
                            </Panel>
                            <Panel header="Действие" key={Math.random()}>
                                <Button type="primary" onClick={() => showDeleteConfirm()} danger>Удалить из
                                                                                                  группы</Button>
                            </Panel>
                        </Collapse>,
                    </div>
                </Content>
            </Layout>
        </Layout>
    );
};

export default Edit;
