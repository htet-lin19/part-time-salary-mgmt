import React from "react";
import { Layout } from "antd";
import Header from "./Header";

const { Content } = Layout;

function Index() {
    return (
        <Layout className="index_layout">
            <Header />
            <Content>
                <div className="site-layout-content">Content</div>
            </Content>
        </Layout>
    );
}

export default Index;
