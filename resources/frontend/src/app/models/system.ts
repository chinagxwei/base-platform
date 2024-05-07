export class System {
}

export class Navigation {
  id?: number;

  parent_id?: number;

  navigation_name: string = "";

  navigation_link?: string = "";

  navigation_sort?: number = 0;

  menu_show?: number = 0;

  icon?: string = "";

  select?: boolean = false;

  created_at?: string;

  updated_at?: string;

  children?: Navigation[]
}

export class Role {

  id?: number;
  role_name: string = ""
  created_at?: string;
  updated_at?: string;
  navigations?: Navigation[]
}

export class SystemConfig {
  id?: number = 0;
  key: string = "";
  value?: string = "";
  created_at?: number = 0;
}

export class SystemAgreement {
  id?: number = 0;
  title: string = "";
  content: string = "";
  type: number = 0;
  show: number = 0;
  created_at?: number = 0;
}

export class SystemComplaint {
  id?: number = 0;
  title: string = "";
  content?: string = "";
  type?: number = 0;
  created_at?: number = 0;
}

export class SystemRouter {
  id?: number = 0;
  router_name: string = "";
  router: string = "";
  created_at?: number = 0;
}

export class RegisterRouter {
  uri: string = "";
  method: string = "";
}

export class SystemImage {
  id?: number;
  title: string = "";
  description?: string = "";
  url?: string = "";
  created_at?: number = 0;
}

export class SystemTag {
  id?: number;
  title: string = "";
  day?: number = 0;
  created_at?: number = 0;
}

export class SystemUnit {
  id?: number;
  title: string = "";
  description?: string = "";
  label?: string = "";
  symbol?: string = "";
  finance: number = 0;
  created_at?: number = 0;
  balance?: { total_balance: number }
}

export class SystemEnterprise {
  id?: string = "";
  name: string = "";
  name_en?: string = "";
  registered_location?: string = "";
  registered_number?: string = "";
  business_registration_number?: string = "";
  registered_province?: string = "";
  registered_city?: string = "";
  registered_address?: string = "";
  registration_time?: string = "";
  business_province?: string = "";
  business_city?: string = "";
  business_address?: string = "";
  website?: string = "";
  registered_category?: number = 0;
  cir_certificate?: string = "";
  br_certificate?: string = "";
  equity_structure?: string = "";
  annual_turnover?: number = 0;
  remark?: string = "";
  status: number = 0
  created_at?: number = 0;
}


