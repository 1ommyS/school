import {Spin, Table} from "antd";
import React from "react";

export const TableContainer = ({columns, data}) => {
        return (<div className="site-layout-background" style={{padding: 24, minHeight: 360}}>
                <Table columns={columns} rowKey="id" dataSource={data} />
            </div>
        )
}